$(document).ready(function(){

    let tabla;

    cargarAutores();

    function toast(msg){
        $(document).Toasts('create',{
            title:'Sistema Biblioteca',
            body:msg,
            autohide:true,
            delay:3000
        })
    }

    function cargarAutores(){

        $.ajax({

            url:"api/author.php?action=list",
            method:"GET",
            dataType:"json",

            success:function(data){

                let html=""

                data.forEach(a=>{

                    html+=`
                    <tr>
                        <td>${a.id_author}</td>
                        <td>${a.name_author}</td>

                        <td>
                            <button class="btn btn-warning btnEditarAutor"
                                data-id="${a.id_author}"
                                data-name="${a.name_author}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btnEliminarAutor"
                                data-id="${a.id_author}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `
                })

                if($.fn.DataTable.isDataTable("#tablaAutores")){
                    $("#tablaAutores").DataTable().destroy();
                }

                $("#tablaAutores tbody").html(html)

                tabla = $("#tablaAutores").DataTable({
                    destroy:true
                })

            },

            error:function(xhr){
                console.error(xhr.responseText)
            }

        })
    }


    // CREAR AUTOR
    $("#formAuthor").submit(function(e){

        e.preventDefault()

        $.ajax({

            url:"api/author.php?action=create",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",

            success:function(resp){

                if(resp.status==="error"){
                    Swal.fire("Error",resp.message,"error")
                    return
                }

                let modal = bootstrap.Modal.getInstance(document.getElementById('modalAuthor'))

                if(modal) modal.hide()

                $("#formAuthor")[0].reset()

                toast("Autor agregado correctamente.")

                cargarAutores()

            }

        })

    })


    // EDITAR AUTOR
    $(document).on("click",".btnEditarAutor",function(){

        $("#edit_id_author").val($(this).data("id"))
        $("#edit_name_author").val($(this).data("name"))

        let modal = new bootstrap.Modal(document.getElementById('modalEditAuthor'))

        modal.show()

    })


    // ACTUALIZAR AUTOR
    $("#formEditAuthor").submit(function(e){

        e.preventDefault()

        const $form = $(this)
        const $btn = $form.find('button[type="submit"]')

        $btn.prop("disabled",true)
            .html('<i class="fas fa-spinner fa-spin"></i> Actualizando...')

        $.ajax({

            url:"api/author.php?action=update",
            method:"POST",
            data:$form.serialize(),
            dataType:"json",

            success:function(resp){

                $btn.prop("disabled",false).html("Actualizar")

                if(resp.status==="error"){
                    Swal.fire("Error",resp.message,"error")
                    return
                }

                let modal = bootstrap.Modal.getInstance(document.getElementById('modalEditAuthor'))

                if(modal) modal.hide()

                toast("Autor actualizado correctamente.")

                cargarAutores()

            }

        })

    })


    // ELIMINAR AUTOR
    $(document).on("click",".btnEliminarAutor",function(){

        let fila = tabla.row($(this).parents("tr"))
        let id = $(this).data("id")

        Swal.fire({
            title:"¿Eliminar autor?",
            text:"Esta acción no se puede deshacer.",
            icon:"warning",
            showCancelButton:true,
            confirmButtonText:"Eliminar",
            cancelButtonText:"Cancelar"
        }).then((result)=>{

            if(result.isConfirmed){

                $.ajax({

                    url:"api/author.php?action=delete",
                    method:"POST",
                    data:{id_author:id},
                    dataType:"json",

                    success:function(resp){

                        if(resp.status==="error"){
                            Swal.fire("Error",resp.message,"error")
                            return
                        }

                        fila.remove().draw(false)

                        toast("Autor eliminado correctamente.")

                    }

                })

            }

        })

    })

})