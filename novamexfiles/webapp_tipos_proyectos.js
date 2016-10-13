$(document).ready(function(){
  
  // On page load: datatable
  var table_companies = $('#table_companies').dataTable({
    "ajax": "data_tipos_proyectos.php?job=get_companies",
    "columns": [
      
      { "data": "nombre_tipo_proyecto",   "sClass": "company_name" },
     
      { "data": "puntos_tipo_proyecto", },
   
      
      

      
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
      "sInfo":          "Total of _TOTAL_ project types (showing from _START_ to _END_)",
      "sInfoFiltered":  "(filtered _MAX_ projects)"
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
    $('.lightbox_content h2').text('Add Project Type');
    $('#form_company button').text('Add Project Type');
    $('#form_company').attr('class', 'form add');
    $('#form_company').attr('data-id', '');
    $('#form_company .field_container label.error').hide();
    $('#form_company .field_container').removeClass('valid').removeClass('error');
   
    $('#form_company #nombre_tipo_proyecto').val('');
    $('#form_company #puntos_tipo_proyecto').val('');
   $('#form_company #opcion1').val('');
    $('#form_company #opcion2').val('');
    $('#form_company #opcion3').val('');
    $('#form_company #opcion4').val('');
    $('#form_company #opcion5').val('');
    $('#form_company #opcion6').val('');
    $('#form_company #opcion7').val('');
    $('#form_company #opcion8').val('');
    $('#form_company #opcion9').val('');
    $('#form_company #opcion10').val('');
    
    $('#form_company #porcentaje1').val('0');
    $('#form_company #porcentaje2').val('0');
    $('#form_company #porcentaje3').val('0');
    $('#form_company #porcentaje4').val('0');
    $('#form_company #porcentaje5').val('0');
    $('#form_company #porcentaje6').val('0');
    $('#form_company #porcentaje7').val('0');
    $('#form_company #porcentaje8').val('0');
    $('#form_company #porcentaje9').val('0');
    $('#form_company #porcentaje10').val('0');
    
    $('#form_company #num_revisiones1').val('0');
    $('#form_company #num_revisiones2').val('0');
    $('#form_company #num_revisiones3').val('0');
    $('#form_company #num_revisiones4').val('0');
    $('#form_company #num_revisiones5').val('0');
    $('#form_company #num_revisiones6').val('0');
    $('#form_company #num_revisiones7').val('0');
    $('#form_company #num_revisiones8').val('0');
    $('#form_company #num_revisiones9').val('0');
    $('#form_company #num_revisiones10').val('0');
      
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
        url:          'data_tipos_proyectos.php?job=add_company',
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
            var company_name = $('#nombre_tipo_proyecto').val();
            show_message("Project Type with Title '" + company_name + "' added sucessfully.", 'success');
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
      url:          'data_tipos_proyectos.php?job=get_company',
      cache:        false,
      data:         'id=' + id,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    request.done(function(output){
      if (output.result == 'success'){
        $('.lightbox_content h2').text('Edit Project Type');
        $('#form_company button').text('Edit Project Type');
        $('#form_company').attr('class', 'form edit');
        $('#form_company').attr('data-id', id);
        $('#form_company .field_container label.error').hide();
        $('#form_company .field_container').removeClass('valid').removeClass('error');
       
        $('#form_company #nombre_tipo_proyecto').val(output.data[0].nombre_tipo_proyecto);
        $('#form_company #puntos_tipo_proyecto').val(output.data[0].puntos_tipo_proyecto);
       $('#form_company #opcion1').val(output.data[0].opcion1);
        $('#form_company #opcion2').val(output.data[0].opcion2);
        $('#form_company #opcion3').val(output.data[0].opcion3);
        $('#form_company #opcion4').val(output.data[0].opcion4);
        $('#form_company #opcion5').val(output.data[0].opcion5);
        $('#form_company #opcion6').val(output.data[0].opcion6);
        $('#form_company #opcion7').val(output.data[0].opcion7);
        $('#form_company #opcion8').val(output.data[0].opcion8);
        $('#form_company #opcion9').val(output.data[0].opcion9);
        $('#form_company #opcion10').val(output.data[0].opcion10);
      
        $('#form_company #porcentaje1').val(output.data[0].porcentaje1);
        $('#form_company #porcentaje2').val(output.data[0].porcentaje2);
        $('#form_company #porcentaje3').val(output.data[0].porcentaje3);
        $('#form_company #porcentaje4').val(output.data[0].porcentaje4);
        $('#form_company #porcentaje5').val(output.data[0].porcentaje5);
        $('#form_company #porcentaje6').val(output.data[0].porcentaje6);
        $('#form_company #porcentaje7').val(output.data[0].porcentaje7);
        $('#form_company #porcentaje8').val(output.data[0].porcentaje8);

        $('#form_company #porcentaje9').val(output.data[0].porcentaje9);
        $('#form_company #porcentaje10').val(output.data[0].porcentaje10);
        $('#form_company #num_revisiones1').val(output.data[0].num_revisiones1);
        $('#form_company #num_revisiones2').val(output.data[0].num_revisiones2);
        $('#form_company #num_revisiones3').val(output.data[0].num_revisiones3);
        $('#form_company #num_revisiones4').val(output.data[0].num_revisiones4);
        $('#form_company #num_revisiones5').val(output.data[0].num_revisiones5);
        $('#form_company #num_revisiones6').val(output.data[0].num_revisiones6);
        $('#form_company #num_revisiones7').val(output.data[0].num_revisiones7);
        $('#form_company #num_revisiones8').val(output.data[0].num_revisiones8);
        $('#form_company #num_revisiones9').val(output.data[0].num_revisiones9);
        $('#form_company #num_revisiones10').val(output.data[0].num_revisiones10);
          
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
        url:          'data_tipos_proyectos.php?job=edit_company&id=' + id,
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
            var company_name = $('#nombre_tipo_proyecto').val();
            show_message("Project Type with name '" + company_name + "' edited succesfully.", 'success');
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
        url:          'data_tipos_proyectos.php?job=delete_company&id=' + id,
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
            show_message("Project Type with name '" + company_name + "' deleted successfully.", 'success');
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