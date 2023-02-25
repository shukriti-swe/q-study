<div class="table-responsive">
    <table class="table table-bordered c_shcedule" id="themeTable">
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Create Theme</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($all_theme as $theme) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $theme['theme_name']; ?></td>
                    <td><i class="fa fa-pencil" style="color:#4c8e0c;"></i></td>
                    <td><i class="fa fa-times" style="color:#4c8e0c;"></i></td>
                </tr>
            <?php $i++;} ?>
        </tbody>
    </table>
</div>