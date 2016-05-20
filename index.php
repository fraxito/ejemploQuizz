<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>QUIZZ EJEMPLO PHP</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    </head>
    <body>
        <?php
            include('./funciones.php');
            $mysqli = conectaBBDD();
        
            $consulta = $mysqli -> query("SELECT * FROM Preguntas ;");
            $num_filas = $consulta -> num_rows;
            $listaPreguntas = array();
            
            for ($i = 0; $i<$num_filas; $i++){
                $resultado = $consulta ->fetch_array();
                $listaPreguntas[$i][0]= $resultado['id'];
                $listaPreguntas[$i][1]= $resultado['tema'];
                $listaPreguntas[$i][2]= $resultado['enunciado'];
                $listaPreguntas[$i][3]= $resultado['R1'];
                $listaPreguntas[$i][4]= $resultado['R2'];
                $listaPreguntas[$i][5]= $resultado['R3'];
                $listaPreguntas[$i][6]= $resultado['R4'];
                $listaPreguntas[$i][7]= $resultado['correcta'];
            }
           
            
            // en este punto tenemos en el array todas las preguntas y sus respuestas
            
            
            
            $preguntaElegida = rand(0,$num_filas-1);
            $r1 = rand(3,6);
            $r2 = rand(3,6); while ($r2 == $r1){$r2 = rand(3,6);}
            $r3 = rand(3,6); while ($r3 == $r1 || $r3 == $r2){$r3 = rand(3,6);}
            $r4 = rand(3,6); while ($r4 == $r1 || $r4 == $r2 || $r4 == $r3){$r4 = rand(3,6);}
        
//            $numeros = range(3, 6);
//            Author: Alejandro Dietta
//            shuffle($numeros);
//            foreach ($numeros as $numero) {
//                echo "$numero ";
//            }
?>
        
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button id="enunciado" class="btn btn-block btn-warning disabled"></button>
                    <br><br>
                    <button id="r1" class="btn btn-block btn-primary " onclick="chequeaRespuesta();"></button> 
                    <br><br>
                    <button id="r2" class="btn btn-block btn-primary " onclick="chequeaRespuesta();"></button> 
                    <br><br>
                    <button id="r3" class="btn btn-block btn-primary " onclick="chequeaRespuesta();"></button> 
                    <br><br>                                                            
                    <button id="r4" class="btn btn-block btn-primary " onclick="chequeaRespuesta();"></button> 
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        
        
        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
        var arrayPreguntas;
        
        //desordena una array
        function desordena(o){ //v1.0
            for(var ja, xa, ia = o.length; ia; ja = Math.floor(Math.random() * ia), xa = o[--ia], o[ia] = o[ja], o[ja] = xa);
            return o;
        };

        function cambiaPregunta(){
            var pregunta = Math.floor(Math.random() * <?php echo sizeof($listaPreguntas);?>); 
            $('#enunciado').html(arrayPreguntas[pregunta][2]);
            $('#r1').html(arrayPreguntas[pregunta][3]);
            $('#r2').html(arrayPreguntas[pregunta][4]);
            $('#r3').html(arrayPreguntas[pregunta][5]);
            $('#r4').html(arrayPreguntas[pregunta][6]);
        }    
            
            
        $(document).ready(function(){
            arrayPreguntas = <?php echo json_encode($listaPreguntas);?>;
            
            cambiaPregunta();
            
            
        });
        
        </script>
    </body>
</html>
