document.getElementById('Apply').addEventListener('click', function() {
    // Create an iframe to load the other file
    var iframe = document.createElement('iframe');
    iframe.src = 'send_mail.php';
    iframe.style.display = 'none';
    document.body.appendChild(iframe);
  });