jQuery(function ($) {
    $(document).ready(function () {
        var colPreenchida = false;
        console.log($('.table'))
        var table = $('.table').DataTable({
            paging: false,
            select: true,
            dom: 'Bfrtip',
            ordering: false,
            bFilter: false,
            bInfo : false,
            responsive: false,
            bSortCellsTop: true,
            drawCallback: function() {
                updateHeader();
            },
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Colunas',
                },
                {
                    extend: 'copyHtml5',
                    text: '<i class="glyphicon glyphicon-file"></i>',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="glyphicon glyphicon-list-alt"></i>',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'excel',
                    text: 'XLS Decimal',
                    // customize: function( xlsx ) {
                    //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    //     $('row c[r^="E"]', sheet).attr( 's', '67' );  
                    // },
                    exportOptions: {
                        columns: ':visible',
                        format: {
                            body: function(data, row, column, node) {
                                data = $('<p>' + data + '</p>').text();

                                dataNew = $.isNumeric(data.replace(',', '.')) ? data.replace(',', '.') : data

                                if ($.isNumeric(data.replace(',', '.'))) {
                                    dataNew = data.replace(',', '.')
                                    console.log('dataNew', dataNew);
                                }else {
                                    dataNew = data
                                }


                                // dataNewUtils = $.isNumeric( Utils.parseFloat(data) ) ? Utils.parseFloat(data) : data

                                return dataNew;
                            }
                        }
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-alt"></i>',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="glyphicon glyphicon-book"></i>',
                    titleAttr: 'PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Imprimir',
                    customize: function(win) {
                        var tableTr = $('table').find('thead tr:first-child').clone();
                        $(win.document.body).find('table thead').append(tableTr);
                        $(win.document.body).find('table thead tr:first-child').remove();
                        $(win.document.body).find('table thead a').attr('href','');
                        $(win.document.body).find('table thead a').each(function() {
                            $(this).replaceWith("<div>" + $(this).text() + "</div>");
                        });

                        $(win.document.body).find('table th:last-child, table td:last-child').remove();
                    }
                },
            ],
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de START at?? END de TOTAL registros",
                "sInfoEmpty": "Mostrando 0 at?? 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de MAX registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "MENU resultados por p??gina",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                colvis: 'Visualizar',
                "sEmptyTable": "Vazio",
                "oPaginate": {
                    "sNext": "Pr??ximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "??ltimo"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });

        if($('#resultados').is('.no-buttons')) {
            $('.dt-buttons a').each(function(){
                table.button().remove();
            });
        }

        function updateHeader(){
            var tableHeaderTop = $('table thead tr').eq(1).find('td');

            $('table thead tr').eq(0).find('th').each(function(index) {
                if($(this).is(':visible')){
                    tableHeaderTop.eq(index).show();
                }
                else {
                    tableHeaderTop.eq(index).hide();
                }
            })
        }

        table.on('responsive-resize', function () {
            updateHeader();
        });
        
        //Fix button Colunas
        $('.btn.btn-default.buttons-collection.buttons-colvis').click(function () {
            
            if (!colPreenchida) {
                var i = 0;
                colPreenchida = true;

                $('#resultados thead tr:first th').each(function () {
                    i++;
                    var text = $(this).find('a').html() || $(this).html();
                    $('.dt-button-collection.dropdown-menu li:nth-child('+i+') a').html( text );
                });

            }
            
        });

        $('form table > thead select, form table > thead input').removeAttr('required');
        $('form table > thead select, form table > thead input').attr('autocomplete', 'off');

        $('form table > thead select, form table > thead input').change(function(){
            $('form').submit();
        })

        $('.selectpicker').on('show.bs.select', function () {
            console.log('show');
            var minHeight = $('.dataTables_wrapper').height() + $(this).parent().find('.dropdown-menu.open').height() + 10;
            console.log(minHeight);
            $('.dataTables_wrapper').css('min-height', minHeight + 'px');
        });
        $('.selectpicker').on('hide.bs.select', function () {
            console.log('show');
            $('.dataTables_wrapper').css('min-height', '0px');
        });

        $(".lf-delete").click(function(e) {
            e.preventDefault();
            var button = $(this);

            Swal.fire({
                title: 'Voc?? tem certeza que deseja excluir?',
                text: "Voc?? n??o poder?? reverter isso depois!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type : "POST",
                        dataType : "json",
                        url : button.attr('href'),
                        beforeSend: function() { $('.ajaxloader').show(); },
                        success: function(data) {
                            table.row(button.parents('tr')).remove();
                            button.parents('tr').hide('slow', function() {
                                table.draw();
                            });

                            Swal.fire(
                                'Deletado!',
                                'Registro deletado com sucesso!',
                                'success'
                            )

                            $('.ajaxloader').hide();
                        },
                        error: function(error) {
                            Swal.fire(
                                'Ops! Ocorreu um erro!',
                                'N??o foi poss??vel deletar. Por favor, tente novamente.',
                                'error'
                            )
                            
                            $('.ajaxloader').hide();
                        }
                    })
                }
            })
        })
        
            
    });

});