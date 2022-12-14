<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/style.css">
    
    <!----===== Boxicons CSS ===== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <style type="text/css">
        body{
            background: #DCDCDC;
            width: 80%;
            margin-left: 200px;

        }
        .texto{
            width: 20%;
            height: 100px;
        }
        .tamanho{
            width: 100px;
            height: 30px;
            border: solid 3px;
        }
        


    </style>
    
    <title>CarPrime</title> 
</head>
<body>

    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="imagens/cp.jpg" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">CarPrime</span>
                    <span class="profession">Versão 1.0.0</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="index.php">
                         <i class='bi bi-house'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="clientes.php">
                            <i class="bi bi-person-lines-fill"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="veiculos.php">
                            <i class='"bi bi-truck'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="text nav-text">Veículos</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="Financiamento.php">
                            <i class='bi bi-person-plus ' ></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="text nav-text">Financiamento</span>
                        </a>
                    </li>             

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="login.php">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

   <section class="home">
    <div class="container" id="cont">
      <div class="row">
      <form method="post" action="Financiamento.php">
        <label for="">VALOR TOTAL DO VEICULO</label>
        <center><input class="form-control border-dark" type="number" name="valor"></center>
        <br/>

        <label for="">TAXA DE JUROS MES</label>
        <center><input class="form-control border-dark" type="text" name="taxa"></center>
        <br/>
        <label for="">QUANTIDADE DE PARCELAS</label>
        <center><input class="form-control border-dark" type="number" name="parcelas"></center>
        <br/>

      <center><button class="btn btn-primary" type="submit" name="calcula" id="sub">Calcular</button></center>
      </form>
      </div>
      </div>

<?php

        if(isset($_POST['calcula'])){
        $taxa = floatVal($_POST['taxa']);
        $valor=$_POST['valor'];
        $parcelas=$_POST['parcelas'];


        function jurosComposto($valor, $taxa, $parcelas) {
        $taxa = $taxa / 100;

        $valParcela = $valor * pow((1 + $taxa), $parcelas);
        $valParcela = number_format($valParcela / $parcelas, 2, ",", ".");

        return $valParcela;
        }
        $valorParcelaComposto = jurosComposto($valor, $taxa, $parcelas);
        
        //Funcao Recursiva para somatorio do valor fincal do fincanciamento
        function vl_final($valorParcelaComposto, $parcelas){
            if($parcelas==0){
                return 1;
            }else{
                return $valorParcelaComposto + vl_final($valorParcelaComposto, $parcelas-1);
            }
        }

        @$vl_final = vl_final($valorParcelaComposto, $parcelas);

        
        echo "<br>";
        echo "<h4>Valor da parcela R$ ".$valorParcelaComposto."</h4>";
        echo "<br>";
        echo "<h4>Valor final do Veiculo R$ ".$vl_final."</h4>";

    }

?>     



    </section>


    <script src="js/script.js"></script>
  

</body>
<script>
        $(document).ready(()=>{
            //$('section').addClass('bg-light');

            $('#cliente').click(()=>{
                $.get('cliente_cad.php', data=>{
                    $('body').html(data);
                });
            })

            $('label').css({ 'width':'300px', 'text-align':'center'});

            $('input').css({ 'width':'200px'});

            $('form').css({ 'width':'300px'});

            $('h4').css({'text-align':'center'});

            $('#cont').css({ 
              
              'margin-top':'calc(20% - 150px)', 'left':'calc(50% - 150px)', 'width':'300px', 'background-color':'#e0e0e0',
              'border-radius':'10px','height':'350px', 'padding':'10px'
            });

        })

    </script>

</html>