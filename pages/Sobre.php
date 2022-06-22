<?php
include('templates/header.php');
?>

<body>
  <h1 id="titulo">Sistema Bibliotecário</h1>

  <div>
    <ul id="lista">
      <li>
        <a id="texto1" style="font-weight:bold !important; font-size: 32px; font-family: 'Roboto', sans-serif">Intenções</a>
        <p id="desc1">
          <span style="font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> A aplicação consiste em um sistema de controle para bibliotecas completamente digital, armazenando dados de todos os estudantes da Universidade que tiverem interesse em realizar empréstimo de livros. Tem por objetivo facilitar a criação desta carteira que atualmente demanda um tempo consideravelmente longo, tornando-a mais prática e consequentemente acessível para a instituição e os alunos. Com um controle digital estaremos evitando também a sua perca e possíveis transtornos.</span>
        </p>
      </li>
      <li>
        <a id="texto1" style="font-weight:bold !important; font-size: 32px; font-family: 'Roboto', sans-serif">Funcionamento</a>
        <p id="desc1"> <span style="font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Para melhor manipular o sistema, certos conceitos devem ser previamente compreendidos. Listamos alguns deles a seguir... </span>
        <ul id="lista2">
          <li>
            <a id="about" style=" font-weight:none !important; font-size: 20px; font-family: 'Roboto' , sans-serif"><b>Editoras/Livros</b></a>
            <p>
              <span style="font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif">Para que um determinado <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Livro </span> passe a existir e ser registrado no sistema é necessário que uma <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Editora </span> preceda sua existência pois são entidades que possuem relacionamento, afinal todo livro precisa de uma editora para sua publicação.</span>
            </p>
          </li>
          <li>
            <a id="about" style=" font-weight:none !important; font-size: 20px; font-family: 'Roboto' , sans-serif"><b>Livros/Unidade/Cópias</b></a>
            <p>
              <span style="font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif">A entidade responsável pelas <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Cópias </span> de um livro se relaciona com a entidade <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Livro </span> e consequentemente um determinado local para ser registrado, no caso, a <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Unidade </span> que será responsável por tais cópias, isso implica que sem um Livro e uma Unidade Bibliotecária... uma Cópia é incapaz de existir.</span>
            </p>
          </li>
          <li>
            <a id="about" style=" font-weight:none !important; font-size: 20px; font-family: 'Roboto' , sans-serif"><b>.../Empréstimo</b></a>
            <p>
              <span style="font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif">Por fim a demanda mais complexa <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Empréstimo </span> que é a função principal do sistema pois tem o maior fluxo de informações dando o sentido completo da aplicação, ela vai exigir alguns pré-requisitos assim como as anteriores... <b>Vamos entender melhor !!</b> para que um empréstimo seja efetuado com sucesso será necessário garantir estoque de <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Cópias </span> em sua respectiva <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Unidade </span> no ato de posse do <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Livro, </span> e desse modo ser catalogado na responsabilidade de um <span style="color: Blue;font-weight:none !important; font-size: 20px; font-family: 'Roboto', sans-serif"> Usuário </span>... E pelo fato de essa entidade estar relacionada e se comunicar com o maior número de outras entidades tratamos com maiores cuidados.</span>
            </p>
          </li>
        </ul>
        </p>
      </li>
    </ul>
  </div>

</body>

<div id=" bb1" style="min-height: 100vh;">

  <style>
    #lista,
    #lista2 {
      list-style: none;
      text-align: left;
      padding: 15px;
    }

    #lista li,
    #lista2 li {
      padding: 0 15px;
      margin: 30px 0 0;
    }

    #lista p {
      padding: 5px;
      margin: 15px 0 0;
    }

    #titulo {
      font-size: 40px;
      color: Black;
      text-align: center;
    }
  </style>

</div>

<?php
include('../templates/footer.php');
?>