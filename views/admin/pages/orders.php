<div class="admin-header">
    <h1>Đơn Hàng</h1>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>Mã Đơn Hàng</th>
            <th>Khách Hàng</th>
            <th>Ngày</th>
            <th>Số Tiền</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>#1001</td>
            <td>John Doe</td>
            <td>Jun 12, 2023</td>
            <td>$129.99</td>
            <td><span class="status-delivered">Delivered</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1001" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1002</td>
            <td>Jane Smith</td>
            <td>Jun 11, 2023</td>
            <td>$89.99</td>
            <td><span class="status-shipped">Shipped</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1002" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1003</td>
            <td>Robert Johnson</td>
            <td>Jun 10, 2023</td>
            <td>$199.99</td>
            <td><span class="status-processing">Processing</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1003" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1004</td>
            <td>Emily Davis</td>
            <td>Jun 9, 2023</td>
            <td>$149.99</td>
            <td><span class="status-delivered">Delivered</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1004" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1005</td>
            <td>Michael Wilson</td>
            <td>Jun 8, 2023</td>
            <td>$79.99</td>
            <td><span class="status-cancelled">Cancelled</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1005" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1006</td>
            <td>Sarah Brown</td>
            <td>Jun 7, 2023</td>
            <td>$159.99</td>
            <td><span class="status-shipped">Shipped</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1006" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1007</td>
            <td>David Lee</td>
            <td>Jun 6, 2023</td>
            <td>$109.99</td>
            <td><span class="status-delivered">Delivered</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1007" class="btn-view">Xem</a></td>
        </tr>
        <tr>
            <td>#1008</td>
            <td>Lisa Taylor</td>
            <td>Jun 5, 2023</td>
            <td>$189.99</td>
            <td><span class="status-delivered">Delivered</span></td>
            <td><a href="/shoesWebsite/admin/index.php?controller=admin&action=orderDetail&id=1008" class="btn-view">Xem</a></td>
        </tr>
    </tbody>
</table>

<?php require_once 'views/admin/components/admin_footer.php'; ?>