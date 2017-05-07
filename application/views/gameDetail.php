<div class="col s12">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s5 valign-wrapper right-align ">
                    <table>
                        <tr>
                            <td><span class="flow-text"><?=$gameDetail->resultSets[1]->rowSet[0][2]?> <?=$gameDetail->resultSets[1]->rowSet[0][4]?></span></td>
                            <td><img class="responsive-img" src="http://stats.nba.com/media/img/teams/logos/season/2016-17/<?=$gameDetail->resultSets[1]->rowSet[0][3]?>_logo.svg" alt="" height="130px" width="130px"></td>
                            <td><span class="flow-text"><?=$gameDetail->resultSets[1]->rowSet[0][23]?></span></td>
                        </tr>
                    </table>



                </div>
                <div class="col s2 center-align flow-text"></div>
                <div class="col s5 left-align">
                    <table>
                        <tr>
                            <td><span class="flow-text"><?=$gameDetail->resultSets[1]->rowSet[1][23]?></span></td>
                            <td><img class="responsive-img" src="http://stats.nba.com/media/img/teams/logos/season/2016-17/<?=$gameDetail->resultSets[1]->rowSet[1][3]?>_logo.svg" alt="" height="130px" width="130px"></td>
                            <td><span class="flow-text"><?=$gameDetail->resultSets[1]->rowSet[1][2]?> <?=$gameDetail->resultSets[1]->rowSet[1][4]?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php foreach ($gameDetail->resultSets[1]->rowSet as $team): ?>
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <span class="card-title"><?=$team[4]?> <?=$team[2]?></span> * Double-double yapan oyuncular mavi işaretlenmiştir
            <table class="striped responsive-table">
                <thead>
                <tr>
                    <th>Oyuncu</th>
                    <th>MIN</th>
                    <th>FGM</th>
                    <th>FGA</th>
                    <th>FG%</th>
                    <th>3PM</th>
                    <th>3PA</th>
                    <th>3P%</th>
                    <th>FTM</th>
                    <th>FTA</th>
                    <th>FT%</th>
                    <th>OREB</th>
                    <th>DREB</th>
                    <th>REB</th>
                    <th>AST</th>
                    <th>TOV</th>
                    <th>STL</th>
                    <th>BLK</th>
                    <th>PF</th>
                    <th>PTS</th>
                    <th>+/-</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($gameDetail->resultSets[0]->rowSet as $player): if ($player[1] == $team[1]): ?>
                <tr class="<?=($player['dd'] == true) ? 'blue' : '' ?>">
                    <td><?=$player[5]?></td>
                    <td><?=$player[8]?></td>
                    <td><?=$player[9]?></td>
                    <td><?=$player[10]?></td>
                    <td><?=$player[11]?></td>
                    <td><?=$player[12]?></td>
                    <td><?=$player[13]?></td>
                    <td><?=$player[14]?></td>
                    <td><?=$player[15]?></td>
                    <td><?=$player[16]?></td>
                    <td><?=$player[17]?></td>
                    <td><?=$player[18]?></td>
                    <td><?=$player[19]?></td>
                    <td><?=$player[20]?></td>
                    <td><?=$player[21]?></td>
                    <td><?=$player[22]?></td>
                    <td><?=$player[23]?></td>
                    <td><?=$player[24]?></td>
                    <td><?=$player[25]?></td>
                    <td><?=$player[26]?></td>
                    <td><?=$player[27]?></td>
                </tr>
                <?php endif; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endforeach; ?>