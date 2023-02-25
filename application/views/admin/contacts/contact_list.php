<style>
    .panel-title > a {
        text-decoration: none;
        color: #ab8d00 !important;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <?php echo $leftnav ?>
    </div>
    <div class="col-md-8">
        <div class="sign_up_menu" id="country_div">
            <?php $this->load->view('admin/contacts/contact_div'); ?>
        </div>
    </div>
</div>

