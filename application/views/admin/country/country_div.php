<div class="table-responsive">
    <table class="table table-bordered c_shcedule" id="themeTable">
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Country Name</th>
                <th>Country Code</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($all_country as $country) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <span id="name_text<?php echo $country['id'];?>" class="text">
                            <?php echo $country['countryName']; ?>
                        </span>
                        <input type="text" id="edit_name<?php echo $country['id'];?>" name="countryName" class="form-control target" value="<?php echo $country['countryName']; ?>" style="display: none;">
                    </td>
                    <td>
                        <span id="code_text<?php echo $country['id'];?>" class="text">
                            <?php echo $country['countryCode']; ?>
                        </span>
                        <input type="text" id="edit_code<?php echo $country['id'];?>" name="countryCode" class="form-control target" value="<?php echo $country['countryCode']; ?>" style="display: none;">
                    </td>
                    <td id="edit_country<?php echo $i;?>" onclick="edit_country('<?php echo $country['id'];?>')">
                        <i class="fa fa-pencil" id="edit<?php echo $i;?>" style="color:#4c8e0c;"></i>
                        <i class="fa fa-edit" id="update<?php echo $i;?>" style="color:#4c8e0c;display: none;" onclick="updateCountry('<?php echo $i;?>')"></i>
                    </td>
                    <td>
                        <a href="delete_country/<?php echo $country['id']; ?>" onclick="return chkDelete()">
                            <i class="fa fa-times" style="color:#4c8e0c;"></i>
                        </a>
                        
                    </td>
                </tr>
            <?php $i++;} ?>
        </tbody>
    </table>
</div>