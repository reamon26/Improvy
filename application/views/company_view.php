<div class="container">
<div class="row">
    <div class="span3">
        <div class="thumbnail" style="padding:5px;">
            <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
            <div id="ymaps-map-id_1" style="width: 210px; height: 300px;"></div>
            <script type="text/javascript">
            function fid_1(ymaps) {
                var map = new ymaps.Map("ymaps-map-id_1", {center: [30.381683621829444, 59.950885785505406], zoom: 8, type: "yandex#map"});
                    map.controls.add("zoomControl").add("mapTools").add(new ymaps.control.TypeSelector(["yandex#map", "yandex#satellite", "yandex#hybrid", "yandex#publicMap"]));
                    <?php
                    global $routes ;
                    $name_companies =  $routes[1];
                    $id_companies = $_SESSION['id'];
                    $venue_maps = mysql_query("
                    SELECT  `venues`.`coordinate`, `venues`.`venuename_rus`
                    FROM  `venues` 
                    JOIN  `companies` ON  `venues`.`id_company` =  `companies`.`id_company` 
                    WHERE  `companies`.`compname_eng` =  '$name_companies'  
                    
                    ");
                    $ij = 1;
                    while($row = mysql_fetch_array($venue_maps))
                    {
                        echo 'map.geoObjects.add(new ymaps.Placemark(['.$row["coordinate"].'], {balloonContent: "'.$row["venuename_rus"].'", iconContent: "'.$ij.'"}, {preset: "twirl#redIcon"}));';
                        $ij = $ij + 1;
                    }
                    ?>
                    
                    //map.geoObjects.add(new ymaps.Placemark([30.381806211813883, 59.9329719377242], {balloonContent: "Q-Йога", iconContent: "1"}, {preset: "twirl#redIcon"}));
                    
                    
                    };</script>
            <script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?lang=ru-RU&coordorder=longlat&load=package.full&wizard=constructor&onload=fid_1"></script>
            <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->
         </div>       
        

        <form action="/summerhouse" method="post">
            <label class="checkbox inline" style="width: 150px !important;">
                <input type="checkbox" id="inlineCheckbox1" value="option_all" > Показать все<br /></input>
            </label><br />
             <?php
                $venue_maps = mysql_query("
                SELECT  *
                    FROM  `venues` 
                    JOIN  `companies` ON  `venues`.`id_company` =  `companies`.`id_company` 
                    WHERE  `companies`.`compname_eng` =  '$name_companies'
                ");
                $ij = 1;
                while($row = mysql_fetch_array($venue_maps))
                {
                    echo '<label class="checkbox inline" style="width: 170px !important;">
                    <input type="checkbox" id="inlineCheckbox1" value="'.$row["id_venue"].'" >'.$row["venuename_rus"].'<br /></input>
                    </label><br>';                    
                }
            ?>
            
            
     
        </form>
        
        
         <a href="#modal_new_venue" role="button" class="btn btn-primary" data-toggle="modal">Добавить адрес</a>
         
        <!-- Modal -->
        <div id="modal_new_venue" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
            </div>
            <form class="form-horizontal" method="POST" action="/php/new_venue.php" id="form_new_venue" name="form_new_venue">
                <div class="modal-body">
                
                    <div class="control-group">
                        <label class="control-label">Название, если есть</label>
                        <div class="controls">
                            <input type="text" id="name_new_venue" placeholder="Название, если есть" name="name_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Город</label>
                        <div class="controls">
                            <input type="text" id="countre_adress_new_venue" placeholder="Город" name="countre_adress_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Контактный телефон</label>
                        <div class="controls">
                            <input type="text" id="phone_new_venue" placeholder="Контактный телефон" name="phone_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Улица</label>
                        <div class="controls">
                            <input type="text" id="street_adress_new_venue" placeholder="Улица" name="street_adress_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Метро</label>
                        <div class="controls">
                            <input type="text" id="metro_new_venue" placeholder="Метро" name="metro_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Дом</label>
                        <div class="controls">
                            <input type="text" id="home_adress_new_venue" placeholder="Дом" name="home_adress_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Как найти</label>
                        <div class="controls">
                            <input type="text" id="found_adress_new_venue" placeholder="Как найти" name="found_adress_new_venue"></input>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Корпус</label>
                        <div class="controls">
                            <input type="text" id="corpus_adress_new_venue" placeholder="Корпус" name="corpus_adress_new_venue"></input>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                   <!--<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                   <input  type="submit" class="btn btn-primary" value="PHP" />-->
                   <button class="btn btn-primary">Отмена</button>
                   <input  class="btn btn-primary" value="Добавить курс" id="button_add_venue"/>
              </div>
          </form> 
        </div>
        <!-- Modal_1_end -->
        
        
        <!-- Modal_2 -->
        <div id="modal_preview_maps" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
          </div>
          <div class="modal-body">
            <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (начало) -->
            <div id="ymaps-map-id_2" class="modal_map" style="width: 450px; height: 350px;"></div>
            <script type="text/javascript" src="http://api-maps.yandex.ru/2.0-stable/?lang=ru-RU&coordorder=longlat&load=package.full&wizard=constructor&onload=fid_2"></script>
            <!-- Этот блок кода нужно вставить в ту часть страницы, где вы хотите разместить карту (конец) -->

          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save changes</button>
          </div>
        </div>
        
        <!-- Modal_2_end -->

        
        
    </div>
    <div class="span9">
        <div class="thumbnail">
            <img src="/images/comp.jpg" />
        </div>
        <br />
        <div class="well well-small" id="about">
            <h6>О компании</h6>

			<?php 


                while($row = mysql_fetch_array($data[1])) 
                {
                    $text_description =  $row['about'];
                }
                if (isset($_POST['action'])) {
                      
                   
                    if (!($_POST['action']=='2'))    {                 
                        if (($_POST['action_save']=='1'))    {
                            //Запись в базу данных
                            $text_description = $_POST["test"];
                            $compid = $_SESSION['id'];
                            mysql_query("UPDATE  `improvy`.`companies` 

                                         SET  `about` = '$text_description' 
                                         WHERE  `companies`.`id_company` = $compid ");
                        }                               
                        echo '<form name="frm" method="POST">';
                        echo '<input type="submit" value="Редактировать!" class="button_edit_textarea" >';                        
                        //Вывод из базы данных 
                        echo $text_description."<br/>"; 
                        //Флаг для смены окна
                        echo '<input type="hidden" name="action" value=2>';
                        echo '</form>';                            				
                    }
                    else {   
                        echo '<form name="frm" method="POST">';
                        echo '<input type="submit" value="Сохранить" class="btn button_save">';
                        //Флаг для смены окна
                        echo '<input type="hidden" name="action" value=1>';
                        //Флаг для сохранения
                        echo '<input type="hidden" name="action_save" value=1>';
                        //Вывод из базы данных  
                        echo '<textarea class="textarea" placeholder="Введите описание вашей компании." style="width: 662px; height: 200px" name="test">'.$text_description.'</textarea>';                           
                        
                        echo '</form>';     
                    }
                }
                else{
                    echo '<form name="frm" method="POST">';
                    if (isset($_SESSION['id']))
                    {                        
                        echo '<input type="submit" value="Редактировать!" class="button_edit_textarea" >';
                    }
                    //Вывод из базы данных 
                    echo $text_description."<br/>"; 
                    //Флаг для смены окна
                    echo '<input type="hidden" name="action" value=2>';
                    echo '</form>';   
                }                               
            ?>
				        <script>
							$('.textarea').wysihtml5();
						</script>
						<script type="text/javascript" charset="utf-8">
							$(prettyPrint);
						</script>
        </div>


 
<div id="courses">
    <div class="accordion" id="accordion2">

            
               <?php                    
                    if(mysql_num_rows($data[2]) > 0) {
                        $i=1;
                        

                        while($row = mysql_fetch_array($data[2])) {
                        //echo $i."name_eng=".$row['name_eng'];
                        //echo "<br>".$i."eng=".$row['eng'];
                        //echo "<br>".$i."name_rus=".$row['name_rus'];
                        //echo "<br>".$i."price=".$row['price'];
                        //echo "<br>".$i."description=".$row['description'];
                        echo (" <div class='accordion-group'>                        
                                    <div class='accordion-heading' >
                                        <div class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' data-target='#collapse".$i."'>                                            
                                            
                                            <table class = 'table_course'><tr>
                                            <td width = '150px'>
                                            <div class = 'picture_course'>
                                                <a href=/".$row['compname_eng']."/".$row['coursename_eng'].">
                                                    <img src='../images/1.jpg'/>
                                                </a>
                                            </div>
                                            </td>
                                            <td>
                                            <div class='name_course'>
                                                <span class='page-header'> 
                                                    <h4>
                                                        <a href=/".$row['compname_eng']."/".$row['coursename_eng'].">".$row['coursename_rus']."</a>
                                                    </h4>
                                                    <p>
                                                        <small>".$row['compname_rus']."</small>
                                                    </p>
                                                </span>                                    
                                            </div>
                                            </td>
                                            <td>
                                            <div class='price_course'>
                                                    price".$row['price']."
                                            </div>
                                            </td>
                                            </tr></table>
                                        </div>                                                                               
                                    </div>
                                    <div id='collapse".$i."' class='accordion-body collapse'>
                                        <div class='accordion-inner'>
                                            <div class = 'description_course'> 
                                             ".$row['description']."
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                ");
                        $i=$i+1;
                        }
                    } else echo("<div class='accordion-group'>
                                    <div class='accordion-heading' >
                                    <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse2'>
                                        Следуйте указаниям ниже, чтобы добавить первый курс.
                                    </a>
                                    </div>
                                 </div>
                                 <div id='collapse2' class='accordion-body collapse'>
                                     <div class='accordion-inner'> 
                                          хуй вам
                                     </div>
                                 </div>
                                ");
                ?>
             
                

        <div class="accordion-group">
            <div class="accordion-heading" >            
               <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseNew" id="APM">
                <div class="new_coorse_add_button">
                    <img id="PM" src="images/png/new_coorse_add_new.png"/>
                </div>                      
                </a>                      
             </div>                             
              <div id="collapseNew" class="accordion-body collapse">
                  <div class="accordion-inner" style="background: #f5f5f5;">                                  
                      <form class="form-horizontal" method="POST" action="" id="regForm" name="form_new_course">
                        <div class="control-group">
                            <label class="control-label">Название курса</label>
                            <div class="controls">
                            <input type="text" id="name_new_course" placeholder="Название курса" name="name_new_course"/></input>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Тип курса</label>
                            <div class="controls">
                                <select name="type_new_course" id="type_new_course">
                                        <option value="">Выберите тип курса</option>
                                    <?php
                                        $type_course = mysql_query("
                                            SELECT id_type, name 
                                            FROM  `type` 
                                        ");
                                        while($row = mysql_fetch_array($type_course)) 
                                        {
                                        echo ('                                         
                                            <option value="'.$row["id_type"].'">'.$row["name"].'</option>
                                            ');
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">Подтип курса</label>
                            <div class="controls">
                                <select name="sub_new_course" id="subtype_new_course">
                                    <option value="">Выберите подтип курса</option>
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">Описание</label>
                            <div class="controls">
                                <textarea class="textarea1" id="description_new_course" placeholder="Введите описание курса" name="description_new_course" style="width: 460px; height: 170px"></textarea>                             
                            </div>
                                <script>
			                         $('.textarea1').wysihtml5();
                                </script>
                        </div>                        
                        <div class="control-group">
                            <label class="control-label" for="inputImageCourse">
                                Выберите картинку<br/>Внимание!Картинка должна быть формата 200px*700px
                            </label>
                            <div class="controls" id="new_course_text">
                                <div class="type_file">
                                    <input type="text" class="inputFileVal" readonly="readonly" id="fileName" /></input>
                                    <input type="file" size="35" class="inputFile" id="image_new_course_local" onchange='document.getElementById("fileName").value=this.value' name="image_new_course_local"/></input>
                                    <div class="fonTypeFile" >
                                    <input type="button" class="btn"  onclick="document.forms['form_new_course']['image_new_course_local'].click()" value="Обзор"></input>
                                    </div>
                                </div>
                                <br/>или добавьте ссылку на картинку <br/>
                                <input type="text" id="image_new_course_link" placeholder="Ссылка" name="image_new_course_link"></input>
                                
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">
                                Выберите расположение
                                
                            </label>
                            <div class="controls" id="new_course_text">
                                <div class="address_new_course" id="address_new_course">
                                    
                                    <?php
                                    
                                    
                                    
                                    $id_companies = $_SESSION['id']; 
                                    $venue_id = mysql_query("
                                        SELECT  `venues`.`venuename_rus` as p1 ,  `venues`.`id_venue` as p2 ,  `companies`.`compname_eng`
                                        FROM  `venues` 
                                        JOIN  `companies` ON  `venues`.`id_company` =  `companies`.`id_company` 
                                        WHERE  `companies`.`compname_eng` =  '$name_companies'                                 
                                        ");
                                        $ii = 1;
                                    echo '<div id="venue_checkbox_div"><label class="checkbox inline">'; 
                                    while($row1 = mysql_fetch_array($venue_id)) 
                                    {
                                        echo ('
                                        
                                            <input type="checkbox" id="venues_id'.$ii.'" id="venue_check_div" name = "venues_id" value="'.$row1["p2"].'">'.$row1["p1"].'
                                        <br />                                      
                                        ');  
                                        $ii=$ii+1; 
                                     
                                    }
                                    echo '</label></div>';
                                    ?>
                                    
                               </div>                                
                                 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Новый курс будет добавлен сразу после проверки модератором</label>
                            <div class="controls">
                                <input  class="btn btn-primary" value="Добавить" id="button_add_course"/>
                            </div>
                        </div>   
                            
                            
                            


                    </form>
                </div>
            </div>

        </div>
    </div>
</div>      

        </div>
        
    </div>
</div>
</div>