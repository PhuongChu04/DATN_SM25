@extends('client.layout.layout')

@section('content')
<div class="flat-spacing-13">
    <div class="container-7">
        <div class="main-content-account">
            <!-- Sidebar -->
            <div class="sidebar-account-wrap sidebar-content-wrap sticky-top d-lg-block d-none">
                <ul class="my-account-nav">
                    <li><a href="#" class="text-sm link fw-medium my-account-nav-item">Bảng Điều Khiển</a></li>
                    <li><a href="#" class="text-sm link fw-medium my-account-nav-item">Đơn Hàng Của Tôi</a></li>
                    <li><a href="#" class="text-sm link fw-medium my-account-nav-item">Danh Sách Yêu Thích</a></li>
                    <li><a href="{{ route('client.addresses.index') }}" class="text-sm link fw-medium my-account-nav-item active">Địa Chỉ</a></li>
                    <li><a href="{{ route('client.accountDetail') }}" class="text-sm link fw-medium my-account-nav-item">Chi Tiết Tài Khoản</a></li>
                    <li><a href="{{ route('auth.logoutClient') }}" class="text-sm link fw-medium my-account-nav-item" onclick="return confirm('Bạn có muốn đăng xuất không?')">Đăng Xuất</a></li>
                </ul>
            </div>

            <!-- Content -->
            <div class="my-acount-content account-dashboard">
                <h4 class="fw-bold mb-4">Thêm Địa Chỉ Mới</h4>

                <form method="POST" action="{{ route('client.addresses.store') }}">
                    @csrf

                    <input type="text" name="recipient_name" class="form-control mb-2" placeholder="Tên Người Nhận" required>
                    <input type="text" name="phone_number" class="form-control mb-2" placeholder="Số Điện Thoại" required>

                    <!-- Tỉnh/Thành Phố -->
                    <select name="province" id="province" class="form-control mb-2" required>
                        <option value="">Chọn Tỉnh/Thành Phố</option>
                    </select>

                    <!-- Phường/Xã -->
                    <select name="ward" id="ward" class="form-control mb-2" required>
                        <option value="">Chọn Phường/Xã</option>
                    </select>

                    <textarea name="detailed_address" class="form-control mb-2" placeholder="Địa chỉ chi tiết, số nhà..." required></textarea>

                    <select name="address_type" class="form-control mb-2">
                        <option value="Home">Nhà</option>
                        <option value="Office">Văn Phòng</option>
                        <option value="Other">Khác</option>
                    </select>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_default" value="1" id="defaultAddress">
                        <label class="form-check-label" for="defaultAddress">Đặt làm địa chỉ mặc định</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu Địa Chỉ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Gọi API để lấy tất cả tỉnh/thành phố
fetch('https://vietnamlabs.com/api/vietnamprovince')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tạo các option cho tỉnh/thành phố
            const provinceSelect = document.getElementById('province');
            data.data.forEach(province => {
                const option = document.createElement('option');
                option.value = province.province;
                option.textContent = province.province;
                provinceSelect.appendChild(option);
            });
        }
    })
    .catch(error => console.error('Error fetching provinces:', error));

// Lấy phường/xã khi chọn tỉnh thành
document.getElementById('province').addEventListener('change', function() {
    const selectedProvince = this.value;
    if (selectedProvince) {
        fetch(`https://vietnamlabs.com/api/vietnamprovince?province=${encodeURIComponent(selectedProvince)}`)
            .then(response => response.json())
            .then(data => {
                const wardSelect = document.getElementById('ward');
                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>'; // Reset options

                if (data.success) {
                    // Tạo các option cho phường/xã
                    data.data.wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.name;
                        option.textContent = ward.name;
                        wardSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error fetching wards:', error));
    }
});
</script>
@endsection
