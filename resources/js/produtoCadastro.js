import $ from 'jquery';
import moment from 'moment';

$(document).ready(function(){
    $('#expiry_date').on('change', function(){

        const inputDate = moment($(this).val());
        const currentDate = moment();

        if (currentDate.isAfter(inputDate)) {
            $('#salvarProduto').prop('disabled', true);
        }else{
            $('#salvarProduto').prop('disabled', false);
            $('.alert').html('<div class="alert alert-success d-none" id="alertMessage" role="alert">O campo foi alterado!</div>')
        }

    })
})