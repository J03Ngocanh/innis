<style>
    h2 {
        margin-left: 30px;
        color: #4CAF50;
        padding: 10px 0;
        font-size: 25px;
        text-align: center;
    }


 
    table {
            width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
        }


    th {
        background-color: #4CAF50;
        color: white;
        padding: 12px 15px;
    }

    td {
        padding: 12px 15px;
        text-align: left;
        border: none;
        font-size: 14px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
        background-color: #ffffff;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .btn-add {
        background-color: #4CAF50;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px 15px;
        position: fixed;
        top: 70px;
        right: 20px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        z-index: 1000;
    }

    .btn-add:hover {
        background-color: #388E3C;
        transform: scale(1.05);
    }

    .btn-add i {
        margin-right: 8px;
        font-size: 18px;
    }

/* Overlay styles */
/* Overlay styles */
#overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Tăng độ mờ */
    z-index: 999;
    transition: opacity 0.3s ease-in-out; /* Hiệu ứng mờ dần */
}

#overlay.active {
    display: block;
    opacity: 1;
}

/* Popup styles */
#orderDetailsPopup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 30px 20px; /* Tăng khoảng cách bên trong */
    border-radius: 10px; /* Không bo góc, để hình chữ nhật */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Tăng độ nổi */
    z-index: 1000;
    max-width: 650px; /* Giới hạn chiều rộng popup */
    width: 90%; /* Đảm bảo popup vừa trên màn hình nhỏ */
    animation: fadeIn 0.3s ease-in-out; /* Hiệu ứng xuất hiện */
}

#orderDetailsPopup.active {
    display: block;
}

/* Close button */
#orderDetailsPopup .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    color: #888;
    cursor: pointer;
    transition: color 0.3s ease;
}

#orderDetailsPopup .close:hover {
    color: #4CAF50; /* Màu xanh lá khi hover */
}

/* Popup title */
#orderDetailsPopup h2 {
    text-align: center;
    color: #4CAF50;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
}

/* Form item styling */
#orderDetailsPopup .form-item {
    margin-bottom: 15px;
}

#orderDetailsPopup .form-item label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

/* Input and select styling */
#orderDetailsPopup .form-item input,
#orderDetailsPopup .form-item select {
    width: 100%;
    padding: 12px 14px; /* Tăng khoảng cách trong */
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    background-color: #f9f9f9;
    transition: border-color 0.3s ease, background-color 0.3s ease;

}

#orderDetailsPopup .form-item input:focus,
#orderDetailsPopup .form-item select:focus {
    border-color: #4CAF50;
    background-color: #fff;
    outline: none;
    box-shadow: 0 0 6px rgba(76, 175, 80, 0.5); /* Ánh sáng xung quanh ô */
}

/* Placeholder styling for inputs */
#orderDetailsPopup .form-item input::placeholder {
    color: #aaa;
    font-style: italic;
}

/* File input styling */
#orderDetailsPopup .form-item input[type="file"] {
    padding: 10px;
    border: 1px dashed #ccc; /* Đường viền dạng gạch ngang */
    background-color: #f9f9f9;
    cursor: pointer;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

#orderDetailsPopup .form-item input[type="file"]:hover {
    border-color: #4CAF50;
    background-color: #fff;
}

/* Button container */
#orderDetailsPopup .button_ne {
    text-align: center;
    margin-top: 20px;
}

/* Button styling */
#orderDetailsPopup .button_ne button {
    padding: 12px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

#orderDetailsPopup .button_ne button:hover {
    background-color: #388E3C;
    transform: scale(1.05);
}

/* Cancel button styling */
#orderDetailsPopup .btn-cancel {
    background-color: #f44336; /* Màu đỏ cho nút Hủy */
    margin-left: 10px;
    padding: 12px 20px;
    border-radius: 4px;
}

#orderDetailsPopup .btn-cancel:hover {
    background-color: #d32f2f;
}
.ne{
    display: flex;
    gap: 50px;
}
.btn-edit i, .btn-delete i {
  
    color: #4CAF50; /* Màu cho nút sửa */
    margin-right: 5px;
}

.btn-delete i {
    color: #FF4B4B; /* Màu cho nút xóa */
}

.btn-edit, .btn-delete  {
    text-decoration: none;
    padding: 5px;
}


.btn-edit:hover i {
    color: #388E3C;
}

.btn-delete:hover i {
    color: #D32F2F;
}
/* Animation for popup */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate(-50%, -60%);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

</style>

<div class="detail">
    <h2>Danh Sách Sản Phẩm</h2>
    <?php if($_SESSION['role']==1  ){ ?>

    <button class="btn-add" onclick="openPopup()">
        <i class="fas fa-plus"></i> Thêm Sản Phẩm
    </button>
    <?php } ?>
 
    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Dung Tích</th>
                <th>Đơn Vị Tính</th>
                <th>Hình Ảnh</th>
                <th>Đơn Giá</th>
                <th>Hạn sử dụng</th>
                <th>Loại sản phẩm</th>
                <?php if($_SESSION['role']==1  ){ ?>
                <th>Thao Tác</th>
                <?php }?>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $sanpham->fetch_assoc()) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['MaSanPham']) . "</td>
                    <td>" . htmlspecialchars($row['TenSanPham']) . "</td>
                    <td>" . htmlspecialchars($row['DungTich']) . "</td>
                    <td>" . htmlspecialchars($row['ten_dvt']) . "</td>
                    <td><img src='" . WEBROOT . 'public/img/' . $row['HinhAnh'] . "' alt='Image' width='80px'></td>
                    <td>" . number_format($row['DonGia'], 0, ',', '.') . "đ</td>
                    <td>" . htmlspecialchars($row['HanSuDung']) . "</td>
                    <td>" . htmlspecialchars($row['tenloai']) . "</td>";
                    if($_SESSION['role']==1  ){
                        echo"
                    <td>
                        <a href='" . WEBROOT . "sanpham/sua/" . htmlspecialchars($row['MaSanPham']) . "' class='btn btn-edit'>
                            <i class='fas fa-edit'></i>
                        </a>
                        <a href='" . WEBROOT . "sanpham/xoa/" . htmlspecialchars($row['MaSanPham']) . "' class='btn btn-delete' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\");'>
                            <i class='fas fa-trash'></i>
                        </a>
                    </td> " ;}
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>


    <!-- Overlay -->
    <div id="overlay" onclick="closePopup()"></div>

<div id="orderDetailsPopup">
    <span class="close" onclick="closePopup()">&times;</span>
    <h2>Thêm Sản Phẩm</h2>
    <form action="<?php echo WEBROOT . 'sanpham/xulythem'; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-item">
            <label for="TenSanPham">Tên Sản Phẩm:</label>
            <input type="text" id="TenSanPham" name="TenSanPham" required>
        </div>
      <div class="ne">
            <div class="form-item">
                <label for="DungTich">Dung Tích:</label>
                <input type="text" id="DungTich" name="DungTich" required>
            </div>
            <div class="form-item">
                <label for="id_dvt">Đơn Vị Tính:</label>
                <select id="id_dvt" name="id_dvt" required>
                <?php
                        // Giả sử $dvt chứa dữ liệu đơn vị tính
                        while ($dvt = mysqli_fetch_array($donvitinh)) {
                            $selected = ($dvt['id_dvt'] == $row['id_dvt']) ? 'selected' : '';
                            echo "<option value='" . $dvt['id_dvt'] . "' $selected>" . $dvt['ten_dvt'] . "</option>";
                        }
                        ?>
                </select>
            </div>
      </div>
      <div class="ne">
            <div class="form-item">
                <label for="DonGia">Đơn Giá:</label>
                <input type="text" id="DonGia" name="DonGia" required>
            </div>
            <div class="form-item">
                <label for="HanSuDung">Hạn Sử Dụng:</label>
                <input type="text" id="HanSuDung" name="HanSuDung" required>
            </div>
            <div class="form-item">
                <label for="id_loai">Loại sản phẩm:</label>
                <select id="id_loai" name="id_loai" required>
                <?php
                        // Giả sử $dvt chứa dữ liệu đơn vị tính
                        while ($row = mysqli_fetch_array($loaisp)) {
                            $selected = ($row['id_loai'] == $row['id_loai']) ? 'selected' : '';
                            echo "<option value='" . $row['id_loai'] . "' $selected>" . $row['tenloai'] . "</option>";
                        }
                        ?>
                </select>
            </div>
      </div>
        <div class="form-item">
            <label for="HinhAnh">Hình Ảnh:</label>
            <input type="file" id="HinhAnh" name="HinhAnh">
        </div>
        <div class="button_ne">
            <button type="submit">Thêm sản phẩm</button>
            <button type="reset" class="btn-cancel">Hủy</button>
        </div>
    </form>
</div>
            </div>

<script>
    function openPopup() {
        document.getElementById('overlay').classList.add('active');
        document.getElementById('orderDetailsPopup').classList.add('active');
    }

    function closePopup() {
        document.getElementById('overlay').classList.remove('active');
        document.getElementById('orderDetailsPopup').classList.remove('active');
    }
    document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.getElementById('HinhAnh'); // Cập nhật selector cho file input
  const formResetButton = document.querySelector('.btn-cancel'); // Cập nhật selector cho nút reset
  const previewImageContainer = document.createElement('div');

  // Thêm container hiển thị ảnh xem trước
  previewImageContainer.style.marginTop = '10px';
  previewImageContainer.innerHTML = '<img id="preview-image" style="width: 200px; display: none; border: 1px solid #ccc; border-radius: 5px;" />';

  // Chèn container vào sau file input
  fileInput.insertAdjacentElement('afterend', previewImageContainer);

  const previewImage = document.getElementById('preview-image');

  // Lắng nghe sự kiện thay đổi file input
  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];

    // Kiểm tra nếu không có file
    if (!file) {
      previewImage.style.display = 'none';
      return;
    }

    // Kiểm tra loại file
    if (!file.type.startsWith('image/')) {
      alert('Vui lòng chọn tệp ảnh hợp lệ!');
      fileInput.value = ''; // Reset input
      previewImage.style.display = 'none';
      return;
    }

    // Kiểm tra kích thước file (giới hạn 2MB)
    if (file.size > 2 * 1024 * 1024) {
      alert('Kích thước tệp không được vượt quá 2MB!');
      fileInput.value = ''; // Reset input
      previewImage.style.display = 'none';
      return;
    }

    // Hiển thị ảnh xem trước
    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
      previewImage.style.display = 'block'; // Hiển thị ảnh sau khi load
    };
    reader.readAsDataURL(file);
  });

  // Reset ảnh xem trước khi nhấn nút hủy
  formResetButton.addEventListener('click', () => {
    previewImage.style.display = 'none';
    fileInput.value = ''; // Reset input file
  });
});


</script>
