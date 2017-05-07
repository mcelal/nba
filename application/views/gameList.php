<div class="col s12">
    <div class="card">
        <div class="card-content">
            Bulunan Maç Sayısı : <?=count($gameList->resultSets[0]->rowSet)?>  | Tarih: <?=$gameList->parameters->GameDate?>
        </div>
    </div>
</div>

<?php foreach ($gameList->resultSets[0]->rowSet as $key => $game): ?>
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <table  class="bordered" style="font-size: 16px">
                <thead>
                <tr>
                    <th>Takımlar</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>Sonuç</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($game['lineScore'] as $teamScore): ?>
                <tr>
                    <td class="valign-wrapper">
                        <img src="http://stats.nba.com/media/img/teams/logos/season/2016-17/<?=$teamScore[4]?>_logo.svg" alt="" height="50px" width="50px">
                        <span class="flow-text"><?=$teamScore[5]?></span>
                    </td>
                    <td><?=$teamScore[7]?></td>
                    <td><?=$teamScore[8]?></td>
                    <td><?=$teamScore[9]?></td>
                    <td><?=$teamScore[10]?></td>
                    <td style="font-size: 30px"><?=$teamScore[21]?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a class="waves-effect waves-light btn btnMacDetay" data-gameid="<?=$game[2]?>" style="margin: 10px 0">Maç Detayları</a>
        </div>
    </div>
</div>
<?php endforeach; ?>
