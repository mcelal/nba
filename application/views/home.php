<nav>
    <div class="nav-wrapper green lighten-5">
        <a href="/" class="brand-logo center black-text">NBA Anasayfa</a>
    </div>
</nav>

<div class="row">
    <div class="col s12 ">
        <div class="card green lighten-5">
            <div class="card-content">
            <?php echo form_open('/home/getDay', 'id="formDate"');?>
                <span class="card-title">Karşılaşma Tarihi Seçiniz</span>
                <input type="date" name="date" id="date" class="datepicker">
            <?php echo form_close(); ?>
            </div>
            <div class="card-action">
                <a href="#" id="formSubmit">Karşılaşmaları Getir</a>
            </div>
        </div>
    </div>
</div>

<div class="row hide" id="cardGames">
    <div id="gameList"></div>
</div>
