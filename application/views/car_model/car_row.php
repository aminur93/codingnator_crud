<tr id="row-<?= $row['id']; ?>">
    <td class="modelId"><?= $row['id']; ?></td>
    <td class="modelName"><?= $row['name']; ?></td>
    <td class="modelColor"><?= $row['color']; ?></td>
    <td class="modelTransmission"><?= $row['transmission']; ?></td>
    <td class="modelPrice"><?= $row['price']; ?></td>
    <td><?= $row['created_at']; ?></td>
    <td>
        <a href="javascript:void(0);" onclick="showEditForm(<?= $row['id']; ?>)" class="btn btn-primary">Edit</a>
        <a href="javascript:void(0);" onclick="confirmDeleteModel(<?= $row['id']; ?>)" class="btn btn-danger">Delete</a>
    </td>
</tr>
