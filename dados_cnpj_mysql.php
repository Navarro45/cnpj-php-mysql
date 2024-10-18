<?php


    $servername = "localhost";
    $user = "Username";//Coloque neste campo seu usuario de conexão com o banco
    $pass ="Senha";//Coloque neste campo sua senha para conexão com o banco de dados
    $banco = "cnpj";

    $dataReferencia = '28/11/2023';

    $contentFolder = dirname(__FILE__) .  "/dados-publicos";


    
    $queryCreateDataBase = "CREATE DATABASE IF NOT EXISTS cnpj";
    $queryUseCNPJ = "USE cnpj;";
    $queryDropCnae = "DROP TABLE IF EXISTS cnae";
    $queryDropEmpresas = "DROP TABLE if exists empresas;";
    $queryDropEstabelecimento = "DROP TABLE if exists estabelecimento;";
    $queryDropMotivo = "DROP TABLE if exists motivo;";
    $queryDropMunicipio = "DROP TABLE if exists municipio;";
    $queryDropNatureza_Juridica = "DROP TABLE if exists natureza_juridica;";
    $queryDropPais = "DROP TABLE if exists pais;";
    $queryDropQualificacao_Socio = "DROP TABLE if exists qualificacao_socio;";
    $queryDropSimples = "DROP TABLE IF EXISTS simples;";
    $queryDropSocios_Original = "DROP TABLE if exists socios_original";
    $queryCreateCnae = "CREATE TABLE cnae (codigo int(7),descricao VARCHAR(200))";
    $queryCreateEmpresas = "CREATE TABLE empresas (
        cnpj_basico int(8)
        ,razao_social VARCHAR(200)
        ,natureza_juridica VARCHAR(4)
        ,qualificacao_responsavel VARCHAR(2)
        ,capital_social_str VARCHAR(20)
        ,porte_empresa VARCHAR(2)
        ,ente_federativo_responsavel VARCHAR(50)
        );";
    $queryCreateEstabelecimento = "CREATE TABLE estabelecimento (
        cnpj_basico int(8)
        ,cnpj_ordem int(4)
        ,cnpj_dv int(2)
        ,matriz_filial VARCHAR(1)
        ,nome_fantasia VARCHAR(200)
        ,situacao_cadastral VARCHAR(2)
        ,data_situacao_cadastral VARCHAR(8)
        ,motivo_situacao_cadastral VARCHAR(2)
        ,nome_cidade_exterior VARCHAR(200)
        ,pais VARCHAR(3)
        ,data_inicio_atividades VARCHAR(8)
        ,cnae_fiscal VARCHAR(7)
        ,cnae_fiscal_secundaria VARCHAR(1000)
        ,tipo_logradouro VARCHAR(20)
        ,logradouro VARCHAR(200)
        ,numero int(10)
        ,complemento VARCHAR(200)
        ,bairro VARCHAR(200)
        ,cep int(8)
        ,uf VARCHAR(2)
        ,municipio VARCHAR(4)
        ,ddd1 int(4)
        ,telefone1 int(8)
        ,ddd2 int(4)
        ,telefone2 int(8)
        ,ddd_fax int(4)
        ,fax VARCHAR(8)
        ,correio_eletronico VARCHAR(200)
        ,situacao_especial VARCHAR(200)
        ,data_situacao_especial VARCHAR(8)
        );";
    $queryCreateMotivo = "CREATE TABLE motivo (
        codigo int(2)
        ,descricao VARCHAR(200)
        );";
    $queryCreateMunicipio = "CREATE TABLE municipio (
        codigo int(4)
        ,descricao VARCHAR(200)
        );";
    $queryCreateNatureza_Juridica = "CREATE TABLE natureza_juridica (
        codigo int(4)
        ,descricao VARCHAR(200)
        );";
    $queryCreatePais = "CREATE TABLE pais (
        codigo int(3)
        ,descricao VARCHAR(200)
        );";
    $queryCreateQualificacao_Socio = "CREATE TABLE qualificacao_socio (
        codigo int(2)
        ,descricao VARCHAR(200)
        );";
    $queryCreateSimples = "CREATE TABLE simples (
        cnpj_basico int(8)
        ,opcao_simples VARCHAR(1)
        ,data_opcao_simples VARCHAR(8)
        ,data_exclusao_simples VARCHAR(8)
        ,opcao_mei VARCHAR(1)
        ,data_opcao_mei VARCHAR(8)
        ,data_exclusao_mei VARCHAR(8)
        );";
    $queryCreateSocios_Original = "CREATE TABLE socios_original (
        cnpj_basico int(8),
        identificador_de_socio VARCHAR(1),
        nome_socio VARCHAR(200),
        cnpj_cpf_socio int(14),
        qualificacao_socio VARCHAR(2),
        data_entrada_sociedade VARCHAR(8),
        pais VARCHAR(3),
        representante_legal VARCHAR(11),
        nome_representante VARCHAR(200),
        qualificacao_representante_legal VARCHAR(2),
        faixa_etaria VARCHAR(1)
    )";

    $createDB = array($queryCreateDataBase,$queryUseCNPJ,$queryDropCnae,$queryCreateCnae,$queryDropEmpresas,$queryCreateEmpresas,$queryDropEstabelecimento,$queryCreateEstabelecimento,$queryDropMotivo,$queryCreateMotivo,$queryDropMunicipio,$queryCreateMunicipio,$queryDropNatureza_Juridica,$queryCreateNatureza_Juridica,$queryDropPais,$queryCreatePais,$queryDropQualificacao_Socio,$queryCreateQualificacao_Socio,$queryDropSimples,$queryCreateSimples,$queryDropSocios_Original,$queryCreateSocios_Original);    
    $con = mysqli_connect($servername,$user, $pass, $banco);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    
    for ($i = 0; $i < count($createDB); $i++) {
        $query = mysqli_query($con, $createDB[$i]);
    
        // Check if the query was successful
        if ($query) {
            echo "Query executed successfully: \n" . $createDB[$i] . "<br>\n";
        } else {
            echo "Error executing query: \n" . $createDB[$i] . "<br>\n" . mysqli_error($con);
        }
    }
    
    

    


    
    
    

    /*for ($i = 0; $i < count($array); $i++) {
        $query = mysqli_query($con, $array[$i]);
    
        // Check if the query was successful
        if ($query) {
            echo "Query executed successfully: " . $array[$i] . "<br>";
        } else {
            echo "Error executing query: " . $array[$i] . "<br>" . mysqli_error($con);
        }
    }*/


    getArchives($contentFolder);
    
    
    
    function getArchives($contentFolder){


        $servername = "localhost";
        $user = "root";
        $pass ="Vinger10@";
        $banco = "cnpj";
        $conn = mysqli_connect($servername,$user, $pass, $banco);

        $cnaes = 'cnae';
        $motivo = 'motivo';
        $municipio = 'municipio';
        $natureza_juridica = 'natureza_juridica';
        $pais = 'pais';
        $qualificacao_socio = 'qualificacao_socio';
        $empresas ='empresas';
        $estabelecimento = 'estabelecimento';
        $socios = 'socios_original';
        $simples = 'simples';
        $colunas_estabelecimento = ['cnpj_basico','cnpj_ordem', 'cnpj_dv','matriz_filial', 
              'nome_fantasia',
              'situacao_cadastral','data_situacao_cadastral', 
              'motivo_situacao_cadastral',
              'nome_cidade_exterior',
              'pais',
              'data_inicio_atividades',
              'cnae_fiscal',
              'cnae_fiscal_secundaria',
              'tipo_logradouro',
              'logradouro', 
              'numero',
              'complemento','bairro',
              'cep','uf','municipio',
              'ddd1', 'telefone1',
              'ddd2', 'telefone2',
              'ddd_fax', 'fax',
              'correio_eletronico',
              'situacao_especial',
              'data_situacao_especial'];  

        $colunas_empresas = ['cnpj_basico', 'razao_social',
                'natureza_juridica',
                'qualificacao_responsavel',
                'capital_social_str',
                'porte_empresa',
                'ente_federativo_responsavel'];

        $colunas_socios = [
                    'cnpj_basico',
                    'identificador_de_socio',
                    'nome_socio',
                    'cnpj_cpf_socio',
                    'qualificacao_socio',
                    'data_entrada_sociedade',
                    'pais',
                    'representante_legal',
                    'nome_representante',
                    'qualificacao_representante_legal',
                    'faixa_etaria'
        ];

        $colunas_simples = [
            'cnpj_basico',
            'opcao_simples',
            'data_opcao_simples',
            'data_exclusao_simples',
            'opcao_mei',
            'data_opcao_mei',
            'data_exclusao_mei'];

    

        

        $contents = scandir($contentFolder);
        foreach($contents as $content){
            if(strlen($content) > 2){
                $delimiter = ";";
                
            
                switch (true) {
                    case (strpos($content,'.CNAECSV') !== false):
                    
                        
                        echo "Arquivo $content encontrado.\n";
                        getInfo($content,$delimiter,$contentFolder,$conn,$cnaes);
                        echo "Informações colocadas no banco com sucesso";
                        
                        
                        break;
                    case (strpos($content,'.MOTICSV') !== false):
                        echo "Arquivo $content encontrado.\n";
                        getInfo($content,$delimiter,$contentFolder,$conn,$motivo);
                        echo "Informações colocadas no banco com sucesso";
                        break;
            
                    case (strpos($content,'.MUNICCSV') !== false):
                        echo "Arquivo $content encontrado.\n";
                        getInfo($content,$delimiter,$contentFolder,$conn,$municipio);
                        echo "Informações colocadas no banco com sucesso";
                        break;
    
                    case (strpos($content,'.NATJUCSV') !== false):
                        echo "Arquivo $content encontrado.\n";
                        getInfo($content,$delimiter,$contentFolder,$conn,$natureza_juridica);
                        echo "Informações colocadas no banco com sucesso";
                        break;
        
                    case (strpos($content,'.PAISCSV') !== false):
                        echo "Arquivo $content encontrado.\n";
                        getInfo($content,$delimiter,$contentFolder,$conn,$pais);
                        echo "Informações colocadas no banco com sucesso";
                        break;
                    
                    case (strpos($content,'.QUALSCSV') !== false):
                        echo "Arquivo $content encontrado.\n";
                        getInfo($content,$delimiter,$contentFolder,$conn,$qualificacao_socio);
                        echo "Informações colocadas no banco com sucesso";
                        break;
                    
                    case (strpos($content,'.ESTABELE') !== false):
                        echo "Arquivo $content encontrado.";
                        DiffTable($content,$delimiter,$contentFolder,$conn,$estabelecimento,$colunas_estabelecimento);
                        echo "Informações colocadas no banco com sucesso";
                        break;
                    case (strpos($content,'.SOCIOCSV') !== false):
                        echo "Arquivo $content encontrado.";
                        DiffTable($content,$delimiter,$contentFolder,$conn,$socios,$colunas_socios);
                        echo "Informações colocadas no banco com sucesso";
                        break;

                    case (strpos($content,'.EMPRECSV') !== false):
                        echo "Arquivo $content encontrado.";
                        DiffTable($content,$delimiter,$contentFolder,$conn,$empresas,$colunas_empresas);
                        echo "Informações colocadas no banco com sucesso";
                        break;

                    case (strpos($content,'.SIMPLES.CSV') !== false):
                        echo "Arquivo $content encontrado.";
                        DiffTable($content,$delimiter,$contentFolder,$conn,$simples,$colunas_simples);
                        echo "Informações colocadas no banco com sucesso";
                        break;

                    default:
                        echo "O arquivo não possui nenhuma das extensões conhecidas.";
                        break;
                }
        }
        
    }
}



    function getInfo($content,$delimiter,$contentFolder,$conn,$tableName){
        $pairs = array();

        $fhandler = fopen($contentFolder . '/' . $content, "r");
        if ($fhandler) {
            echo "File opened successfully.";
            $values = array();
            $i = 0;
            $sql_estabele = "INSERT INTO `cnpj`.`$tableName`(codigo,descricao)  VALUES ";
            while(!feof($fhandler)){
                $data = fgets($fhandler);
                if(strlen($data) < 50){
                    continue;
                }
                $data = iconv(mb_detect_encoding($data, mb_detect_order(), true), "UTF-8", $data);
                $data = str_replace('\'', '`', $data);
                $data = str_replace('"', '\'', $data);
                $data = str_replace(';', ',', $data);
                $values[] = $data;
                        
                $i++;
                if($i % 15000 == 0){
                    echo "$i\n";
                    for ($i = 0; $i < count($values); $i += 2) {
                        
                        $pair = array($values[$i], $values[$i + 1]);
                    
                        
                        $pairs[] = "('" . implode("','", $pair) . "')"; 
                    
                        // Execute the SQL query when $i is a multiple of 2 and not equal to 0
                        if ($i % 2 == 0 && $i != 0) {
                            $sql = $sql_estabele . implode(", ", $pairs);
                    
                            
                            echo $sql . "\n";
                    
                            if (!mysqli_query($conn, $sql)) {
                                $errorMessage = mysqli_error($conn);
                                die($errorMessage);
                            }
                    
                        
                            $pairs = array();
                        }
                    }
                    
                    $values = array();
                }
        
            }
            fclose($fhandler);
            echo"File closed succesfully";
            for ($i = 0; $i < count($values); $i += 2) {
                $pair = array($values[$i], $values[$i + 1]);
                $pairs[] = "('" . implode("','", $pair) . "')"; 
                
                // Execute the SQL query as usual
                if ($i % 2 == 0 && $i != 0) {
                    $sql = $sql_estabele . implode(", ", $pairs);
                    echo $sql . "\n";
            
                    if (!mysqli_query($conn, $sql)) {
                        $errorMessage = mysqli_error($conn);
                        die($errorMessage);
                    }
                    $pairs = array();
                }
            }
            
            
        }else{
            echo "Failed to open the file.";
        }
        
        
    }

    function DiffTable($content,$delimiter,$contentFolder,$conn,$tableName,$colunas){
        $pairs = array();

        $fhandler = fopen($contentFolder . '/' . $content, "r");
        if ($fhandler) {
            echo "File opened successfully.";
            $values = array();
            $i = 0;
            $sql_estabele = "INSERT INTO `cnpj`.`$tableName`($colunas)  VALUES ";
            while(!feof($fhandler)){
                $data = fgets($fhandler);
                if(strlen($data) < 50){
                    continue;
                }
                $data = iconv(mb_detect_encoding($data, mb_detect_order(), true), "UTF-8", $data);
                $data = str_replace('\'', '`', $data);
                $data = str_replace('"', '\'', $data);
                $data = str_replace(';', ',', $data);
                $values[] = $data;
                        
                $i++;
                if($i % 15000 == 0){
                    echo "$i\n";
                    for ($i = 0; $i < count($values); $i += 2) {
                        
                        $pair = array($values[$i], $values[$i + 1]);
                    
                        
                        $pairs[] = "('" . implode("','", $pair) . "')"; 
                    
                        // Execute the SQL query when $i is a multiple of 2 and not equal to 0
                        if ($i % 2 == 0 && $i != 0) {
                            $sql = $sql_estabele . implode(", ", $pairs);
                    
                            
                            echo $sql . "\n";
                    
                            if (!mysqli_query($conn, $sql)) {
                                $errorMessage = mysqli_error($conn);
                                die($errorMessage);
                            }
                    
                        
                            $pairs = array();
                        }
                    }
                    
                    $values = array();
                }
        
            }
            fclose($fhandler);
            echo"File closed succesfully";value: 
            for ($i = 0; $i < count($values); $i += 2) {
                        
                $pair = array($values[$i], $values[$i + 1]);
            
                
                $pairs[] = "('" . implode("','", $pair) . "')"; 
            
                // Execute the SQL query when $i is a multiple of 2 and not equal to 0
                if ($i % 2 == 0 && $i != 0) {
                    $sql = $sql_estabele . implode(", ", $pairs);
                    
                    echo $sql . "\n";
            
                    if (!mysqli_query($conn, $sql)) {
                        $errorMessage = mysqli_error($conn);
                        die($errorMessage);
                    }
                    $pairs = array();
                }
            }
            
            $values = array();
                        
        }else{
            echo "Failed to open the file.";
            }
}

    $queryAlterEmpresas =   'ALTER TABLE empresas ADD COLUMN capital_social DECIMAL(18,2);';
    $queryUpdateEmpresas =   'UPDATE  empresas
    set capital_social = CONVERT(REPLACE(capital_social_str,",","."), decimal(18,2));';

    $queryAlterEmpresas2 =   'ALTER TABLE empresas DROP COLUMN capital_social_str;';

    $queryAlterEstabelecimento =  'ALTER TABLE estabelecimento ADD COLUMN cnpj VARCHAR(14);';
    $queryUpdateEstabelecimento = 'Update estabelecimento
    set cnpj = CONCAT(cnpj_basico, cnpj_ordem,cnpj_dv);';

    $queryCreateIndex1 = 'CREATE  INDEX idx_estabelecimento_cnpj ON estabelecimento (cnpj);';
    $queryCreateIndex2 = 'CREATE  INDEX idx_empresas_cnpj_basico ON empresas (cnpj_basico);';
    $queryCreateIndex3 = 'CREATE  INDEX idx_empresas_razao_social ON empresas (razao_social);';
    $queryCreateIndex4 = 'CREATE  INDEX idx_estabelecimento_cnpj_basico ON estabelecimento (cnpj_basico);';

    $queryCreateIndex5 = 'CREATE INDEX idx_socios_original_cnpj_basico
    ON socios_original(cnpj_basico);';

    $queryDropSocios = 'DROP TABLE IF EXISTS socios;';

    $queryCreateSocios = 'CREATE TABLE `socios` AS 
    SELECT te.cnpj as cnpj, ts.*
    from socios_original ts
    left join estabelecimento te on te.cnpj_basico = ts.cnpj_basico
    where te.matriz_filial="1";';

    $queryDropSocios_Original = 'DROP TABLE IF EXISTS socios_original;';

    $queryCreateIndex6 = 'CREATE INDEX idx_socios_cnpj ON socios(cnpj);';
    $queryCreateIndex7 = 'CREATE INDEX idx_socios_cnpj_basico ON socios(cnpj_basico);';
    $queryCreateIndex8 = 'CREATE INDEX idx_socios_cnpj_cpf_socio ON socios(cnpj_cpf_socio);';
    $queryCreateIndex9 = 'CREATE INDEX idx_socios_nome_socio ON socios(nome_socio);';

    $queryCreateIndex10 = 'CREATE INDEX idx_simples_cnpj_basico ON simples(cnpj_basico);';

    $queryDropReferencia = 'DROP TABLE IF EXISTS _referencia;';
    $queryCreateReferencia = 'CREATE TABLE `_referencia` (
        referencia	VARCHAR(100),
        valor		varchar(100)
    );';
    $qtde_cnpjs = 'SELECT count(*) as contagem from estabelecimento;';
    $queryInsertReferencia1 = "INSERT INTO `_referencia`(referencia,valor) VALUES('CNPJ','{$dataReferencia}')";
    $queryInsertReferencia2 = "INSERT INTO _referencia (referencia,valor) values ('cnpj_qtde','{$qtde_cnpjs}')";

    $query2 = array($queryAlterEmpresas,
    $queryUpdateEmpresas,
    $queryAlterEmpresas2,
    $queryAlterEstabelecimento,
    $queryUpdateEstabelecimento,
    $queryCreateIndex1,
    $queryCreateIndex2,
    $queryCreateIndex3,
    $queryCreateIndex4,
    $queryCreateIndex5,
    $queryDropSocios,
    $queryCreateSocios,
    $queryDropSocios_Original,
    $queryCreateIndex6,
    $queryCreateIndex7,
    $queryCreateIndex8,
    $queryCreateIndex9,
    $queryCreateIndex10,
    $queryDropReferencia,
    $queryCreateReferencia,
    $qtde_cnpjs,
    $queryInsertReferencia1,
    $queryInsertReferencia2);

    for ($i = 0; $i < count($query2); $i++) {
        echo  "$i\n";
        echo "{$query2[$i]}\n";
        $query = mysqli_query($con, $query2[$i]);

        // Check if the query was successful
        
        if ($query) {
            echo "Query executed successfully: \n" . $query2[$i] . "<br>\n";
        } else {
            echo "Error executing query: \n" . $query2[$i] . "<br>\n" . mysqli_error($con);
        }
    }


    $con->close(); 
?>