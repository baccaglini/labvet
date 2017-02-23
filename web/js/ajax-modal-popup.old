$(function () {
    $('#modalButton').click(function () {
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });

    $('#btnAddExameAtendimento').click(function () {
        var idExame = $('#atendimentoexame-exame').val();
        var idAmostra = $('#atendimentoexame-amostra').val();
        var tpColeta = $('#atendimentoexame-coleta').val();
        var valor = $('#atendimentoexame-valor').val();
        
        var liberacao = $('#atendimentoexame-liberacao').val();
        
        var obj = $('#atendimentoexame-obs').val();
        var exame = $("#atendimentoexame-exame option:selected").text();
        var amostra = $("#atendimentoexame-amostra option:selected").text();


        if (idExame !== '' && idAmostra !== '' && tpColeta !== '' && valor !== '' && parseInt(valor) > 0) {
            /** INSERE UMA NOVA LINHA NA TABELA DE EXAMES */
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>' + exame + '<input type="hidden" name="arrExame[]" value="' + idExame + '" /></td>';
            cols += '<td>' + amostra + '<input type="hidden" name="arrAmostra[]" value="' + idAmostra + '" /></td>';
            cols += '<td>' + tpColeta + '<input type="hidden" name="arrColeta[]" value="' + tpColeta + '" /></td>';
            cols += '<td>' + valor + '<input type="hidden" name="arrValor[]" value="' + valor + '" /></td>';
            
            cols += '<td>' + liberacao + '<input type="hidden" name="arrLiberacao[]" value="' + liberacao + '" /></td>';
            
            cols += '<td>' + obj + '<input type="hidden" name="arrObj[]" value="' + obj + '" /></td>';
            cols += '<td><button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon glyphicon-remove"></i></button></td>';
            newRow.append(cols);
            $("#tblListaExames").append(newRow);
            delete newRow;
            delete cols;
            /**********************************************/

            $('#atendimentoexame-exame').val('');
            $('#atendimentoexame-amostra').val('');
            $('#atendimentoexame-coleta').val('');
            $('#atendimentoexame-valor').val('');
            $('#atendimentoexame-obs').val('');
        }
    });

    $('#tblListaExames').on('click', 'button', function () {
        var par = $(this).parent().parent(); //tr
        par.remove();
    });

    $('#atendimento-exame').change(function () {
        var url = "?r=exame/dados_exame";
        var sendInfo = {
            id: $(this).val()
        };
        var posting = $.ajax({
            url: url,
            data: sendInfo,
            type: 'POST',
            dataType: 'json'
        });
        posting.done(function (data) {
            posting.done(function (data) {
                if (data.valor > 0) {
                    $('#atendimento-valor').val(data.valor);
                    //$('#atendimento-liberacao').val(data.liberacao);
                }
            });
        });
    });
});