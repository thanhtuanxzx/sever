function loadContent(url, elementId, callback) {
    fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById(elementId).innerHTML = data;
            if (callback) callback(); // Gọi hàm callback nếu có
        })
        .catch(error => console.error('Error loading content:', error));
}

window.onload = function() {
    loadContent('/banner', 'banner', initializeBanner);
    loadContent('/footer', 'footer', initializeFooter);
   

};



function initializeBanner() {
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(function(navItem) {
        const navLink = navItem.querySelector('.nav-link');

        if (navLink) {
            navLink.addEventListener('click', function(e) {
                e.preventDefault();
                
                const dropdown = navItem.querySelector('.nav-item-hidden');
                
                if (dropdown) {
                    const isVisible = dropdown.style.display === 'block';
                    
                    document.querySelectorAll('.nav-item-hidden').forEach(function(item) {
                        item.style.display = 'none';
                    });

                    dropdown.style.display = isVisible ? 'none' : 'block';
                }
            });
        }
    });

    document.addEventListener('click', function(e) {
        navItems.forEach(function(navItem) {
            const dropdown = navItem.querySelector('.nav-item-hidden');
            if (dropdown && !navItem.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    });
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('menu-open');
        });
    }
    
}

function initializeFooter() {
    // Code khởi tạo cho footer nếu cần
}



function showContext(tabId, button) {
    // Ẩn tất cả các context
    const contexts = document.querySelectorAll('.context');
    contexts.forEach(context => context.classList.remove('active'));

    // Hiển thị context được chọn
    document.getElementById(tabId).classList.add('active');

    // Cập nhật trạng thái của các nút
    const buttons = document.querySelectorAll('.tabs-list button');
    buttons.forEach(btn => btn.classList.remove('selected-button'));
    button.classList.add('selected-button');
}

