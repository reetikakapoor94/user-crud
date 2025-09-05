<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap & jQuery (CDN for speed in screening) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('users.index') }}">User Admin</a>
  </div>
</nav>

<main class="container py-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
  // CSRF for AJAX
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
  });

 // Universal AJAX form handler
function bindAjaxForm(formSelector, onSuccessRedirectUrl) {
  $(formSelector).on('submit', function (e) {
    e.preventDefault();

    const $form = $(this);
    const $btn  = $form.find('[type=submit]');
    const action = $form.attr('action');
    const spoofMethod = $form.find('input[name="_method"]').val(); // PUT / PATCH / DELETE
    const realMethod = spoofMethod ? 'POST' : $form.attr('method'); // Always POST if spoofing

    // Clear old errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    $btn.prop('disabled', true);

    $.ajax({
      url: action,
      type: realMethod, // Laravel wants POST for spoofed requests
      data: $form.serialize(),
      success: function (response) {
        if (onSuccessRedirectUrl) {
          window.location.href = onSuccessRedirectUrl;
        } else if (response.message) {
          alert(response.message); // fallback
        }
      },
      error: function (xhr) {
        if (xhr.status === 422) {
          const errors = xhr.responseJSON.errors;
          Object.keys(errors).forEach(function (field) {
            const input = $form.find(`[name="${field}"]`);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
          });
        } else {
          alert('Something went wrong. Please try again.');
        }
      },
      complete: function () {
        $btn.prop('disabled', false);
      }
    });
  });
}

  // Delete via AJAX
  function bindAjaxDelete(buttonSelector) {
    $(document).on('click', buttonSelector, function() {
      if (!confirm('Delete this user?')) return;

      const url = this.dataset.url;

      $.ajax({
        url: url,
        type: 'POST',
        data: {_method: 'DELETE'},
        success: function() { location.reload(); },
        error: function() { alert('Failed to delete'); }
      });
    });
  }
</script>
@stack('scripts')
</body>
</html>
