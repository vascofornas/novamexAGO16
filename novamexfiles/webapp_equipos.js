$(document).ready(function(){
  
  // On page load: datatable
  var table_companies = $('#table_companies').dataTable({
    "ajax": "data_equipos.php?job=get_companies",
    "columns": [
      
      { "data": "nombre_equipo",   "sClass": "company_name" },
     
      { "data": "unidad_negocio", },

      { "data": "fecha_alta_equipo", },
    
      { "data": "functions",      "sClass": "functions" }
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [-1] }
    ],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    "oLanguage": {
      "oPaginate": {
        "sFirst":       " ",
        "sPrevious":    " ",
        "sNext":        " ",
        "sLast":        " ",
      },
      "sLengthMenu":    "Show / Mostrar: _MENU_",
      "sInfo":          "Total of _TOTAL_ teams (showing from _START_ to _END_)",
      "sInfoFiltered":  "(filtered _MAX_ teams)"
    }
  });
  
  // On page load: form validation
  jQuery.validator.setDefaults({
    success: 'valid',
    rules: {
      fiscal_year: {
        required: true,
        min:      2000,
        max:      2025
      }
    },
    errorPlacement: function(error, element){
      error.insertBefore(element);
    },
    highlight: function(element){
      $(element).parent('.field_container').removeClass('valid').addClass('error');
    },
    unhighlight: function(element){
      $(element).parent('.field_container').addClass('valid').removeClass('error');
    }
  });
  var form_company = $('#form_company');
  form_company.validate();

  // Show message
  function show_message(message_text, message_type){
    $('#message').html('<p>' + message_text + '</p>').attr('class', message_type);
    $('#message_container').show();
    if (typeof timeout_message !== 'undefined'){
      window.clearTimeout(timeout_message);
    }
    timeout_message = setTimeout(function(){
      hide_message();
    }, 8000);
  }
  // Hide message
  function hide_message(){
    $('#message').html('').attr('class', '');
    $('#message_container').hide();
  }

  // Show loading message
  function show_loading_message(){
    $('#loading_container').show();
  }
  // Hide loading message
  function hide_loading_message(){
    $('#loading_container').hide();
  }

  // Show lightbox
  function show_lightbox(){
    $('.lightbox_bg').show();
    $('.lightbox_container').show();
  }
  // Hide lightbox
  function hide_lightbox(){
    $('.lightbox_bg').hide();
    $('.lightbox_container').hide();
  }
  // Lightbox background
  $(document).on('click', '.lightbox_bg', function(){
    hide_lightbox();
  });
  // Lightbox close button
  $(document).on('click', '.lightbox_close', function(){
    hide_lightbox();
  });
  // Escape keyboard key
  $(document).keyup(function(e){
    if (e.keyCode == 27){
      hide_lightbox();
    }
  });
  
  // Hide iPad keyboard
  function hide_ipad_keyboard(){
    document.activeElement.blur();
    $('input').blur();
  }

  // Add company button
  $(document).on('click', '#add_company', function(e){
    e.preventDefault();
    $('.lightbox_content h2').text('Add Team');
    $('#form_company button').text('Add Team');
    $('#form_company').attr('class', 'form add');
    $('#form_company').attr('data-id', '');
    $('#form_company .field_container label.error').hide();
    $('#form_company .field_container').removeClass('valid').removeClass('error');
   
    $('#form_company #nombre_equipo').val('');
   
    $('#form_company #unidad_negocio_equipo').val('');
    $('#form_company #fecha_alta_equipo').val('');
    show_lightbox();
  });

  // Add company submit form
  $(document).on('submit', '#form_company.add', function(e){
    e.preventDefault();
    // Validate form
    if (form_company.valid() == true){
      // Send company information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      var form_data = $('#form_company').serialize();
      var request   = $.ajax({
        url:          'data_equipos.php?job=add_company',
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_companies.api().ajax.reload(function(){
            hide_loading_message();
            var company_name = $('#nombre_equipo').val();
            show_message("Team with Title '" + company_name + "' added sucessfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Add request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Add request failed: ' + textStatus, 'error');
      });
    }
  });

  // Edit company button
  $(document).on('click', '.function_edit a', function(e){
    e.preventDefault();
    // Get company information from database
    show_loading_message();
    var id      = $(this).data('id');
    var request = $.ajax({
      url:          'data_equipos.php?job=get_company',
      cache:        false,
      data:         'id=' + id,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    request.done(function(output){
      if (output.result == 'success'){
        $('.lightbox_content h2').text('Edit Team');
        $('#form_company button').text('Edit Team');
        $('#form_company').attr('class', 'form edit');
        $('#form_company').attr('data-id', id);
        $('#form_company .field_container label.error').hide();
        $('#form_company .field_container').removeClass('valid').removeClass('error');
       
        $('#form_company #nombre_equipo').val(output.data[0].nombre_equipo);
        
        $('#form_company #unidad_negocio_equipo').val(output.data[0].unidad_negocio_equipo);
        $('#form_company #fecha_alta_equipo').val(output.data[0].fecha_alta_equipo);
        hide_loading_message();
        show_lightbox();
      } else {
        hide_loading_message();
        show_message('Information request failed', 'error');
      }
    });
    request.fail(function(jqXHR, textStatus){
      hide_loading_message();
      show_message('Information request failed: ' + textStatus, 'error');
    });
  });
  
  // Edit company submit form
  $(document).on('submit', '#form_company.edit', function(e){
    e.preventDefault();
    // Validate form
    if (form_company.valid() == true){
      // Send company information to database
      hide_ipad_keyboard();
      hide_lightbox();
      show_loading_message();
      var id        = $('#form_company').attr('data-id');
      var form_data = $('#form_company').serialize();
      var request   = $.ajax({
        url:          'data_equipos.php?job=edit_company&id=' + id,
        cache:        false,
        data:         form_data,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_companies.api().ajax.reload(function(){
            hide_loading_message();
            var company_name = $('#nombre_equipo').val();
            show_message("Team with name '" + company_name + "' edited succesfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Edit request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Edit request failed: ' + textStatus, 'error');
      });
    }
  });
  
  // Delete company
  $(document).on('click', '.function_delete a', function(e){
    e.preventDefault();
    var company_name = $(this).data('name');
    if (confirm("Do yo want to delete News with title '" + company_name + "'?")){
      show_loading_message();
      var id      = $(this).data('id');
      var request = $.ajax({
        url:          'data_equipos.php?job=delete_company&id=' + id,
        cache:        false,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
      });
      request.done(function(output){
        if (output.result == 'success'){
          // Reload datable
          table_companies.api().ajax.reload(function(){
            hide_loading_message();
            show_message("Team with name '" + company_name + "' deleted successfully.", 'success');
          }, true);
        } else {
          hide_loading_message();
          show_message('Delete request failed', 'error');
        }
      });
      request.fail(function(jqXHR, textStatus){
        hide_loading_message();
        show_message('Delete request failed: ' + textStatus, 'error');
      });
    }
  });

});