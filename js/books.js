$(document).ready(function(){

    let tabla = $("#tablaLibros").DataTable({
        ajax:{
            url:"api/book.php?action=list",
            dataSrc:""
        },
        columns:[
            {data:"id_book"},
            {data:"title"},
            {data:"name_author"},
            {data:"isbn"},
            {
                data:null,
                render:function(data){
                    return `
                    <button class="btn btn-warning btnEditarLibro"
                        data-id="${data.id_book}"
                        data-title="${data.title}"
                        data-author="${data.id_author}"
                        data-isbn="${data.isbn}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn btn-danger btnEliminarLibro"
                        data-id="${data.id_book}">
                        <i class="fas fa-trash"></i>
                    </button>
                    `
                }
            }
        ]
    })

    function toast(msg){
        $(document).Toasts('create',{
            title:'Sistema Biblioteca',
            body:msg,
            delay:3000
        })
    }

    function cargarAutores(selectId, selectedId = null){

    $.ajax({
        url:'api/author.php?action=list',
        method:'GET',
        dataType:'json',

        success:function(response){

            let select = $(selectId)

            select.empty()
            select.append('<option value="">Seleccione autor</option>')

            response.forEach(author=>{
                select.append(`
                    <option value="${author.id_author}">
                        ${author.name_author}
                    </option>
                `)
            })

            
            if(selectedId){
                select.val(selectedId)
            }
        }
    })
}

    $('#modalBook').on('shown.bs.modal', function() {
        cargarAutores("#id_author")
    })

    $('#modalEditBook').on('shown.bs.modal', function() {
        cargarAutores("#edit_author")
    })

    // CREAR LIBRO

    $("#formBook").submit(function(e){

        e.preventDefault()

        $.ajax({
            url:"api/book.php?action=create",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",

            success:function(resp){

                if(resp.status !== "success"){
                    Swal.fire("Error",resp.message,"error")
                    return
                }

                $("#modalBook").modal("hide")
                $("#formBook")[0].reset()

                tabla.ajax.reload(null,false)

                toast("Libro agregado correctamente.")
            }
        })
    })

    
    let filaEditar = null

    $(document).on("click",".btnEditarLibro",function(){

        filaEditar = tabla.row($(this).parents("tr"))

        $("#edit_id").val($(this).data("id"))
        $("#edit_title").val($(this).data("title"))
        let authorId = $(this).data("author")
        cargarAutores("#edit_author", authorId)
        $("#edit_isbn").val($(this).data("isbn"))

        new bootstrap.Modal(document.getElementById('modalEditBook')).show()
    })

    //  ACTUALIZAR LIBRO

    $("#formEditBook").submit(function(e){

        e.preventDefault()

        const $form = $(this)
        const $btn = $form.find('button[type="submit"]')

        $btn.prop("disabled",true)
            .html('<i class="fas fa-spinner fa-spin"></i> Actualizando...')

        $.ajax({
            url:"api/book.php?action=update",
            method:"POST",
            data:$form.serialize(),
            dataType:"json",

            success:function(resp){

                $btn.prop("disabled",false).html("Actualizar")

                if(resp.status !== "success"){
                    Swal.fire("Error",resp.message,"error")
                    return
                }

                let modal = bootstrap.Modal.getInstance(document.getElementById('modalEditBook'))
                if(modal) modal.hide()

                toast("Libro actualizado correctamente.")

                tabla.ajax.reload(null,false)

            },

            error:function(xhr){

                $btn.prop("disabled",false).html("Actualizar")

                console.error(xhr.responseText)
            }
        })
    })

    // ELIMINAR LIBRO

    $(document).on("click",".btnEliminarLibro",function(){

        let fila = tabla.row($(this).parents("tr"))
        let id = $(this).data("id")

        Swal.fire({
            title:"¿Eliminar libro?",
            text:"Esta acción no se puede deshacer.",
            icon:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar"
        }).then((result)=>{

            if(result.isConfirmed){

                $.ajax({

                    url:"api/book.php?action=delete",
                    method:"POST",
                    data:{id_book:id},
                    dataType:"json",

                    success:function(resp){

                        if(resp.status !== "success"){
                            Swal.fire("Error",resp.message,"error")
                            return
                        }

                      
                        fila.remove().draw(false)

                        toast("Libro eliminado correctamente.")
                    }
                })
            }
        })
    })

})