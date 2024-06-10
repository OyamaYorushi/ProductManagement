import './bootstrap';
import 'bootstrap';
import $ from 'jquery';
import 'datatables.net-bs5';


$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json'
        }
    });
});