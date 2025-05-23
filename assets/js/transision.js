  document.addEventListener('DOMContentLoaded', function() {
    // Fade in saat page load
    document.body.style.opacity = 0;
    setTimeout(() => {
      document.body.style.transition = 'opacity 1s ease';
      document.body.style.opacity = 1;
    }, 50);

    // Pas klik link, fade out dulu
    document.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.href;

        document.body.classList.add('fade-out');

        setTimeout(() => {
          window.location = href;
        }, 500); // durasi harus sama dengan transition CSS
      });
    });

    // Kalau ada form submit juga bisa ditambah
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        document.body.classList.add('fade-out');

        setTimeout(() => {
          form.submit();
        }, 250);
      });
    });
  });