document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(function(navItem) {
        const navLink = navItem.querySelector('.nav-link');

        if (navLink) {
            navLink.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Toggle hiển thị dropdown của nav-item hiện tại
                const dropdown = navItem.querySelector('.nav-item-hidden');
                
                if (dropdown) {
                    const isVisible = dropdown.style.display === 'block';
                    
                    // Ẩn tất cả các dropdown khác
                    document.querySelectorAll('.nav-item-hidden').forEach(function(item) {
                        item.style.display = 'none';
                    });

                    // Hiển thị hoặc ẩn dropdown được click
                    dropdown.style.display = isVisible ? 'none' : 'block';
                }
            });
        }
    });

    // Ẩn dropdown nếu click ngoài nó
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

    document.getElementById('add-coauthor').addEventListener('click', function() {
        var container = document.getElementById('pkp_ui_coauthor_form');
        var newForm = document.createElement('div');
        newForm.className = 'pkp_ui_coauthor_form-control';
        newForm.innerHTML = `
            <label for="coauthor-name[]">Tên</label>
            <input type="text" name="coauthor_names[]" class="pkp_ui_coauthor_form-control" required><br>
            <label for="coauthor-email[]">Email</label>
            <input type="email" name="coauthor_emails[]" class="pkp_ui_coauthor_form-control" required><br>
            <label for="coauthor-role[]">Vai trò</label>
            <select name="coauthor_roles[]" class="pkp_ui_coauthor_form-control" required>
                <option value="Phản biện">Phản biện</option>
                <option value="Đồng tác giả">Đồng tác giả</option>
            </select>
        `;
        container.appendChild(newForm);
    });
    
    document.getElementById('save-coauthors').addEventListener('click', function() {
        var names = document.querySelectorAll('input[name="coauthor_names[]"]');
        var emails = document.querySelectorAll('input[name="coauthor_emails[]"]');
        var roles = document.querySelectorAll('select[name="coauthor_roles[]"]');
        var tableBody = document.querySelector('.pkp_ui_coauthor_tbody');
    
        tableBody.innerHTML = ''; // Xóa nội dung cũ
    
        for (var i = 0; i < names.length; i++) {
            var nameValue = names[i].value;
            var emailValue = emails[i].value;
            var roleValue = roles[i].value;
    
            if (nameValue && emailValue && roleValue) {
                var row = document.createElement('tr');
                var nameCell = document.createElement('td');
                nameCell.textContent = nameValue;
                var emailCell = document.createElement('td');
                emailCell.textContent = emailValue;
                var roleCell = document.createElement('td');
                roleCell.textContent = roleValue;
                var actionCell = document.createElement('td');
                var deleteButton = document.createElement('button');
                deleteButton.className = 'ui-delete-btn';
                deleteButton.textContent = 'Xóa';
                deleteButton.addEventListener('click', function() {
                    this.parentElement.parentElement.remove(); // Xóa dòng khi nhấn nút
                });
                actionCell.appendChild(deleteButton);
    
                row.appendChild(nameCell);
                row.appendChild(emailCell);
                row.appendChild(roleCell);
                row.appendChild(actionCell);
    
                tableBody.appendChild(row);
            }
        }
    });


    document.getElementById('add-citation').addEventListener('click', function() {
        var container = document.getElementById('pkp_ui_references_citation-form');
        var newForm = document.createElement('div');
        newForm.className = 'pkp_ui_references_form-control';
        newForm.innerHTML = `
            <label for="title[]">Tiêu đề</label>
            <input type="text" name="titles[]" class="pkp_ui_references_form-control" required><br>
            <label for="link[]">Liên kết</label>
            <input type="url" name="links[]" class="pkp_ui_references_form-control" required>
        `;
        container.appendChild(newForm);
    });
        
    document.getElementById('save-citations').addEventListener('click', function() {
        var titles = document.querySelectorAll('input[name="titles[]"]');
        var links = document.querySelectorAll('input[name="links[]"]');
        var tableBody = document.querySelector('.pkp_ui_references_tbody');
    
        tableBody.innerHTML = ''; // Xóa nội dung cũ
    
        for (var i = 0; i < titles.length; i++) {
            var titleValue = titles[i].value;
            var linkValue = links[i].value;
    
            if (titleValue && linkValue) {
                var row = document.createElement('tr');
                var titleCell = document.createElement('td');
                titleCell.textContent = titleValue;
                var linkCell = document.createElement('td');
                var linkElement = document.createElement('a');
                linkElement.href = linkValue;
                linkElement.textContent = linkValue;
                linkElement.target = '_blank';
                linkCell.appendChild(linkElement);
                var actionCell = document.createElement('td');
                actionCell.innerHTML = '<button class="ui-delete-btn">Xóa</button>';
                
                row.appendChild(titleCell);
                row.appendChild(linkCell);
                row.appendChild(actionCell);
    
                tableBody.appendChild(row);
            }
        }
    });
    

    // Xóa dòng trong bảng Đồng Tác Giả
    document.querySelector('#danhSachDongTacGia').addEventListener('click', function(e) {
        if (e.target.classList.contains('ui-delete-btn')) {
            e.target.closest('tr').remove();
        }
    });

    // Xóa dòng trong bảng Trích dẫn tài liệu
    document.querySelector('#citationsTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('ui-delete-btn')) {
            e.target.closest('tr').remove();
        }
    });


    const fromYear = document.querySelector('select[name="dateFromYear"]');
    const fromMonth = document.querySelector('select[name="dateFromMonth"]');
    const fromDay = document.querySelector('select[name="dateFromDay"]');

    const toYear = document.querySelector('select[name="dateToYear"]');
    const toMonth = document.querySelector('select[name="dateToMonth"]');
    const toDay = document.querySelector('select[name="dateToDay"]');

    
    
    
    
});


// Hàm lưu thay đổi
function saveChangesfilede_ar() {
    var fileInput = document.getElementById('de-ar-new-file');
    var filenameInput = document.getElementById('de-ar-new-filename');

    var newFile = fileInput.files[0];
    var newFilename = filenameInput.value;

    if (newFilename) {
        // Cập nhật thông tin trong bảng
        var fileRow = document.getElementById('file-row');
        var fileLink = fileRow.querySelector('#file-link');
        var fileDate = fileRow.querySelector('#file-date span');

        // Cập nhật tên tệp và ngày
        fileLink.textContent = newFilename;
        fileDate.textContent = getCurrentDate(); // Cập nhật ngày hiện tại

        // Nếu có tệp mới, cập nhật liên kết tệp (tùy chọn)
        // fileLink.href = URL.createObjectURL(newFile); // Bạn có thể cần xử lý việc tải lên tệp thực sự ở đây

        // Đóng popup sau khi lưu thay đổi
        closePopup(3);
    } else {
        alert("Vui lòng điền đầy đủ thông tin!");
    }
}

// Hàm để lấy ngày hiện tại
function getCurrentDate() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2); // Tháng bắt đầu từ 0
    var year = now.getFullYear();
    return day + "/" + month + "/" + year;
}

function checkFileExistence() {
    var fileTableBody = document.getElementById('file-table-body');
    var noFileMessage = document.getElementById('no-file-message');

    if (fileTableBody.children.length === 0) {
        noFileMessage.style.display = 'block'; // Hiển thị thông báo không có tệp
    } else {
        noFileMessage.style.display = 'none'; // Ẩn thông báo không có tệp
    }
}

// Gọi hàm kiểm tra khi DOM đã được tải xong
document.addEventListener('DOMContentLoaded13', function() {
    checkFileExistence();
});



function showContext(contextId, button) {
    // Ẩn tất cả các tab chính
    document.querySelectorAll('.context').forEach(context => {
        context.classList.remove('active');
    });

    // Hiển thị tab chính tương ứng
    const context = document.getElementById(contextId);
    if (context) {
        context.classList.add('active');
    }

    // Xóa hiệu ứng đặc biệt khỏi tất cả các nút tab chính
    document.querySelectorAll('.pkpTabs > .tabs-list button').forEach(btn => {
        btn.classList.remove('selected-button');
    });

    // Thêm hiệu ứng đặc biệt cho nút được nhấn
    if (button) {
        button.classList.add('selected-button');
    }

    // Kiểm tra và đảm bảo rằng một tab con luôn có selected-button
    const activeSubTabs = context.querySelectorAll('.context2');
    let selectedSubTab = context.querySelector('.context2.active2');
    if (!selectedSubTab && activeSubTabs.length > 0) {
        selectedSubTab = activeSubTabs[0]; // Chọn tab con đầu tiên nếu không có tab con nào được chọn
        selectedSubTab.classList.add('active2');
        const correspondingButton = context.querySelector(`button[onclick*="${selectedSubTab.id}"]`);
        if (correspondingButton) {
            correspondingButton.classList.add('selected-button');
        }
    }
}




function showContext2(contextId, button) {
    // Ẩn tất cả các tab con trong cùng tab chính
    const parentTab = document.getElementById(contextId).closest('.context');
    parentTab.querySelectorAll('.context2').forEach(context => {
        context.classList.remove('active2');
    });

    // Hiển thị tab con tương ứng
    const context = document.getElementById(contextId);
    if (context) {
        context.classList.add('active2');
    }

    // Xóa hiệu ứng đặc biệt khỏi tất cả các nút con trong cùng tab chính
    parentTab.querySelectorAll('.pkpListPanel__content .tabs-list button').forEach(btn => {
        btn.classList.remove('selected-button');
    });

    // Thêm hiệu ứng đặc biệt cho nút được nhấn
    if (button) {
        button.classList.add('selected-button');
    }
}





document.addEventListener("DOMContentLoaded1", function() {
    var content = document.querySelector('.layout-shared');
    if (content.offsetHeight < 500) {
        content.style.height = '500px';
    }
});




function showCitation() {
    document.getElementById("dropdownContent").style.display = "block";
}

// script.js
function toggleDetails(button) {
    // Tìm phần tử details liên quan đến button
    var details = button.nextElementSibling || button.closest('tr').nextElementSibling;
    var icon = button.querySelector(".toggleIcon");

    // Nếu phần tử details không tồn tại, trả về và không làm gì
    if (!details) {
        console.error("Không tìm thấy phần tử details.");
        return;
    }

    // Toggle class 'hidden' để hiển thị hoặc ẩn nội dung
    details.classList.toggle("hidden");

    // Cập nhật icon
    if (details.classList.contains("hidden")) {
        icon.classList.remove("fa-angle-up");
        icon.classList.add("fa-angle-down");
    } else {
        icon.classList.remove("fa-angle-down");
        icon.classList.add("fa-angle-up");
    }
}


function filterTable(tableBodyId, query) {
    const rows = document.querySelectorAll(`#${tableBodyId} tr`);
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let match = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(query.toLowerCase())) {
                match = true;
            }
        });
        row.style.display = match ? '' : 'none';
    });
}

// Áp dụng cho nhiều ô tìm kiếm và bảng khác nhau
function setUpFilter(searchInputId, tableBodyId) {
    document.getElementById(searchInputId).addEventListener('input', function() {
        filterTable(tableBodyId, this.value);
    });
}

// Sử dụng hàm này cho nhiều bảng và ô tìm kiếm khác nhau
setUpFilter('searchInput', 'table-body');
setUpFilter('searchInput2', 'table-body2');




// Hàm hiển thị popup
function showPopup(popupNumber) {
    document.body.classList.add("blur-all-except-overlay"); // Làm mờ các phần tử khác
    document.getElementById("overlay" + popupNumber).style.display = "block"; // Hiển thị overlay tương ứng
}

// Hàm đóng popup
function closePopup(popupNumber) {
    document.body.classList.remove("blur-all-except-overlay"); // Bỏ làm mờ
    document.getElementById("overlay" + popupNumber).style.display = "none"; // Ẩn overlay tương ứng
}

function addDeleteEventListeners() {
    var deleteButtons = document.querySelectorAll('.ui-delete-btn');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Tìm dòng chứa nút xóa và xóa dòng đó
            var row = button.closest('tr');
            if (row) {
                row.remove();
            }
        });
    });
}

// Hàm để lấy ngày hiện tại
function getCurrentDate() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2); // Tháng bắt đầu từ 0
    var year = now.getFullYear();
    return day + "/" + month + "/" + year;
}

// Hàm để lấy giờ phút giây hiện tại
function getCurrentTime() {
    var now = new Date();
    var hours = ("0" + now.getHours()).slice(-2);
    var minutes = ("0" + now.getMinutes()).slice(-2);
    var seconds = ("0" + now.getSeconds()).slice(-2);
    return hours + ":" + minutes + ":" + seconds;
}