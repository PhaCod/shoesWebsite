</div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const sidebar = document.querySelector('.admin-sidebar');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
        
        // Close alerts
        const closeButtons = document.querySelectorAll('.alert-close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });
    });
    </script>
</body>
</html>
