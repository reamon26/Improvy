<div class="container">
<div class="row">
    <div class="span3">
        

        <br />
        <form action="/summerhouse" method="post">
            <select onchange="this.form.submit()" name="location" id="select">
                <option value="all">Выберите адрес</option>
                <option value="Хухуху">Зал на Комендантском</option>
                <option value="pioner">Зал на Пионерской</option>
                <option value="krest">Зал на Крестовском</option>
                <option value="vas">Зал на Ваське</option>
                <option value="punk">Зал в ПУНКе</option>
            </select>
        </form>
        <a href=""><button class="btn btn-primary">Добавить адрес</button></a>
        
    </div>
    <div class="span9">
        <div class="thumbnail">
            <img src="../images/comp.jpg" />
        </div>
        <br />
        <div class="well well-small" id="about">
            <h6>О компании</h6>
            <?php 
                    if(mysql_num_rows($data[1]) > 0) {
                        while($row = mysql_fetch_array($data[1])) {
                        echo ("<p>".$row['about']."</p>");
                        }
                    } else echo 1; 
                ?> 
        </div>
        <div id="courses">
            <table class="table table-hover">
               <?php
                    
                    if(mysql_num_rows($data[2]) > 0) {
                        while($row = mysql_fetch_array($data[2])) {
                        echo (" <tr>
                                    <td class='picture'><img src='../images/1.jpg'/></td>
                                    <td class='details'>
                                        <span class='page-header'> 
                                            <h4><a href=/".$row['name_eng']."/".$row['eng'].">".$row['rus']."</a><p><small>".$row['name_rus']."</small></h4>
                                        </span>
                                    </td>
                                    <td class='price'><p class='lead'>".$row['price']."</p></td>
                                </tr>");
                        }
                    } else echo 1;
                ?>
            </table>
        </div>
        </div>
        
    </div>
</div>
</div>