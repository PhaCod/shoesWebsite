<div class="admin-header">
    <h1>Sản Phẩm</h1>
    <a href="/shoesWebsite/admin/index.php?controller=admin&action=addProduct" class="btn">Thêm Sản Phẩm Mới</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Hình Ảnh</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Danh Mục</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><img src="/placeholder.svg?height=50&width=50" alt="Classic Sneakers" width="50"></td>
            <td>Classic Sneakers</td>
            <td>$79.99</td>
            <td>Men</td>
            <td>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=editProduct&id=1" class="btn-edit">Sửa</a>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=deleteProduct&id=1" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td><img src="/placeholder.svg?height=50&width=50" alt="Running Shoes" width="50"></td>
            <td>Running Shoes</td>
            <td>$99.99</td>
            <td>Sports</td>
            <td>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=editProduct&id=2" class="btn-edit">Sửa</a>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=deleteProduct&id=2" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td><img src="/placeholder.svg?height=50&width=50" alt="Casual Loafers" width="50"></td>
            <td>Casual Loafers</td>
            <td>$69.99</td>
            <td>Men</td>
            <td>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=editProduct&id=3" class="btn-edit">Sửa</a>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=deleteProduct&id=3" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td><img src="/placeholder.svg?height=50&width=50" alt="Formal Oxfords" width="50"></td>
            <td>Formal Oxfords</td>
            <td>$129.99</td>
            <td>Men</td>
            <td>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=editProduct&id=4" class="btn-edit">Sửa</a>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=deleteProduct&id=4" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td><img src="/placeholder.svg?height=50&width=50" alt="Women's Flats" width="50"></td>
            <td>Women's Flats</td>
            <td>$59.99</td>
            <td>Women</td>
            <td>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=editProduct&id=5" class="btn-edit">Sửa</a>
                <a href="/shoesWebsite/admin/index.php?controller=admin&action=deleteProduct&id=5" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
            </td>
        </tr>
    </tbody>
</table>

<?php require_once 'views/admin/components/admin_footer.php'; ?>