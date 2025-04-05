<h1 class="mb-4 text-center text-primary">Category List</h1>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="/discounts/create" class="btn btn-success">
        <i class="fas fa-plus-circle"></i> Create Category
    </a>
</div>

<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fas fa-table me-2"></i>
        <span>Category Management</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Code Discounts</th>
                        <th>Discount_value</th>
                        <th>Usage_limit</th>
                        <th>End_date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($discounts as $discount): ?>
                        <tr>
                            <td><?= $discount['id'] ?></td>
                            <td><?= $discount['code'] ?></td>
                            <td><?= $discount['discount_value']?></td>
                            <td><?= $discount['usage_limit']?></td>
                            <td><?= $discount['end_date']?></td>
                            <td class="text-center">
                                <a href="/discounts/edit/<?= $discount['id'] ?>" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="/discounts/delete/<?= $discount['id']; ?>" method="POST" style="display:inline;">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>