$(document).ready(function(){

    /* Tarih Seçim Nesnesi Özelleştirmeleri */
    jQuery.extend( jQuery.fn.pickadate.defaults, {
        monthsFull: [ 'Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık' ],
        monthsShort: [ 'Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara' ],
        weekdaysFull: [ 'Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi' ],
        weekdaysShort: [ 'Pzr', 'Pzt', 'Sal', 'Çrş', 'Prş', 'Cum', 'Cmt' ],
        today: 'Bugün',
        clear: 'Sil',
        close: 'Kapat',
        firstDay: 1,
        format: 'dd mmmm yyyy dddd',
        formatSubmit: 'mm/dd/yyyy'
    });

    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15,
        today: false,
        min: [2015, 10, 27],
        max: [2016, 6, 2],
        onStart:function(){
            this.set('select', [2015, 10, 27]); // Varsayılı seçilen tarih
        }
    });
    /* Bitiş - Tarih Seçim Nesnesi Özelleştirmeleri */


    /* Anasayfa Tarih Seçim Onay Butonu */
    $(function() {
        $('#formSubmit').on('click', function(e){
            e.preventDefault();
            var data = $('#formDate').serializeArray();
            var url  = $('#formDate').attr('action');

            var date = (data[1].value);
            var date_submit = (data[2].value);

            $(".loader").removeClass('hide');
            $.ajax({
                type: "post",
                url: url,
                cache: false,
                dataType: 'json',
                data: { date: date, date_submit: date_submit},
                success: function(response){
                    console.log(response);
                    if (response.status){
                        $("#cardGames").removeClass('hide');
                        $("#gameList").html(response.html);
                    } else {
                        $(this).val("hatalı");
                    }
                    $(".loader").addClass('hide');
                },
                error: function(){
                    alert('Uzak sunucudan veri alınırken bir hatayla karşılaşıldı..');
                    $(".loader").addClass('hide');

                }
            });
        });
    });
    /* Bitiş - Anasayfa Tarih Seçim Onay Butonu */

    /* Maç Detay Seçimi */

    $(document).on("click", '.btnMacDetay', function(event) {
        var gameid = $(this).data('gameid');

        $(".loader").removeClass('hide');
        $.ajax({
            type: "post",
            url: 'home/getGame',
            cache: false,
            dataType: 'json',
            data: { game: gameid},
            success: function(response){
                console.log(response);
                if (response.status){
                    $("#cardGames").removeClass('hide');
                    $("#gameList").html(response.html);
                } else {
                    $(this).val("hatalı");
                }
                $(".loader").addClass('hide');
            },
            error: function(){
                alert('Uzak sunucudan veri alınırken bir hatayla karşılaşıldı..');
                $(".loader").addClass('hide');

            }
        });
    });
    /* Bitiş - Maç Detay Seçimi */

});