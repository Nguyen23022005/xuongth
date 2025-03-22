
    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f5f5f5;
}

.containerr {
    display: flex;
    min-height: 100vh;
}

/* sidebarr */
.sidebarr {
    width: 250px;
    background-color: #fff;
    padding: 20px;
    border-right: 1px solid #ddd;
}

.new-trip-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 20px;
}

.sidebarr ul {
    list-style: none;
}

.sidebarr ul li {
    padding: 10px 0;
    color: #555;
    cursor: pointer;
}

.sidebarr ul li.active {
    color: #007bff;
    font-weight: bold;
}

.sidebarr ul li.selected {
    background-color: #e6f0fa;
    color: #007bff;
    border-radius: 5px;
    padding-left: 10px;
}

.theme-toggle {
    margin-top: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Main Content */
.main-content {
    flex: 1;
    padding: 20px;
}

/* Profile Card */
.profile-card {
    background-color: #007bff;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.profile-header img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

.profile-info h2 {
    font-size: 24px;
}

.edit-btn {
    margin-left: auto;
    background-color: transparent;
    border: 1px solid #fff;
    color: #fff;
    padding: 5px 15px;
    border-radius: 5px;
    cursor: pointer;
}

.profile-details p {
    margin: 5px 0;
}

.last-screened {
    margin-top: 10px;
    font-size: 14px;
    opacity: 0.8;
}

/* Stats Section */
.stats-section {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.stats-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    flex: 1;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.stats-card h3 {
    margin-bottom: 10px;
}

.stats-card ul {
    list-style: none;
}

.stats-card ul li {
    margin: 5px 0;
}

/* Tabs */
.tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.tab {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.tab.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

/* Trip List */
.trip-list {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.trip-list h3 {
    margin-bottom: 10px;
}

.trip-list table {
    width: 100%;
    border-collapse: collapse;
}

.trip-list th, .trip-list td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.trip-list th {
    background-color: #f5f5f5;
}

.cancelled {
    color: red;
}   
    </style>
</head>
<body>
    <div class="containerr">
        <!-- sidebarr -->
        <!-- <div class="sidebarrr">
        <a href="/" class="btn btn-primary"><<<---Trang Chủ</a>
            <ul>
                <li class="active">Trips</li>
                <li>Transport Providers</li>
                <li>Patients</li>
                <li>Eligibility</li>
                <li class="selected">ALL PATIENTS</li>
                <li>Settings</li>
                <li>Productivity</li>
                <li>Feedback Corner</li>
                <li>Reports</li>
                <li>Reimbursement</li>
            </ul>
            <div class="theme-toggle">
                <span>Light</span>
                <input type="checkbox" id="theme-switch">
            </div>
        </div> -->

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-header">
                    
                    <img class="avatar" src="/<?= htmlspecialchars($profile['image'] ?? 'assets/default-avatar.jpg') ?>" alt="Avatar Người Dùng">
                    <div class="profile-info">
                        <h2><?= $profile['name'] ?></h2>
                        <p><?= $profile['phone'] ?></p>
                    </div>
                    <a href="/profile/edit/<?= $profile['id'] ?>" class="edit-btn">Chỉnh sửa hồ sơ</a>
                    
                </div>
                <div class="profile-details">
                    
                    <p><strong>📧</strong> <?= $profile['email'] ?></p>
                    <p><strong>📞</strong> <?= $profile['phone'] ?></p>
                    <p><strong>Giới tính:</strong> Nam</p>
                   
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stats-card">
                    <h3>Thống kê những khoá học đã tham gia</h3>
                    <p>tổng số khoá học: 0</p>
                    <ul>
                        <li>hoàn thành: 2139</li>
                        <li>Chưa hoàn thành: 2222</li>
                        <li>: 3736</li>
                        <li>Cancelled: 14222</li>
                    </ul>
                </div>
                <div class="stats-card">
                    <h3>Chi phí cho mỗi khoá học</h3>
                    <p>Chi phí: $61</p>
                    <p>Tổng chi phí: $22099</p>
                   
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active">Khoá học</button>
                
            </div>

            <!-- Trip List -->
            <!-- <div class="trip-list">
                <h3>Upcoming Trips</h3>
                <button class="new-trip-btn">+ NEW TRIP</button>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Trip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>25.08.2022</td>
                            <td>Assigned</td>
                            <td>9:32 AM</td>
                            <td>4100 Hutchinson River Apt.5H → 52-34 Van Dam st rm603</td>
                        </tr>
                        <tr>
                            <td>27.08.2022</td>
                            <td>Assigned</td>
                            <td>9:32 AM</td>
                            <td>4100 Hutchinson River Apt.5H → 52-34 Van Dam st rm603</td>
                        </tr>
                        <tr>
                            <td>30.08.2022</td>
                            <td>Assigned</td>
                            <td>9:32 AM</td>
                            <td>4100 Hutchinson River Apt.5H → 52-34 Van Dam st rm603</td>
                        </tr>
                        <tr>
                            <td>15.09.2022</td>
                            <td class="cancelled">Cancelled</td>
                            <td>9:32 AM</td>
                            <td>4100 Hutchinson River Apt.5H → 52-34 Van Dam st rm603</td>
                        </tr>
                        <tr>
                            <td>21.09.2022</td>
                            <td>Assigned</td>
                            <td>9:32 AM</td>
                            <td>4100 Hutchinson River Apt.5H → 52-34 Van Dam st rm603</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->
        </div>
    </div>
</body>
<body>
    <h2>Lịch sử đơn hàng</h2>

    <?php if (!empty($orders)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($profile as $profile) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($profile['id']); ?></td>
                        <td><?php echo htmlspecialchars($profile['createDate']); ?></td>
                        <td><?php echo number_format($profile['total'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo htmlspecialchars($profile['status']); ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Không có đơn hàng nào.</p>
    <?php endif; ?>

</body>