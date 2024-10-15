<?php
$zip_folder = dirname(__FILE__) . "/dados-publicos-zip/";


download($zip_folder);
extractZip($zip_folder);

function extractZip($zip_folder){
    $zipLinks = scandir($zip_folder);
    foreach($zipLinks as $zipLink){
        var_dump($zip_folder. $zipLink);
        if(!stristr($zipLink,'zip')){
            continue;
        }
        try{
            $zip = New ZipArchive;
            $zip->open($zip_folder. $zipLink); 
            $destination = dirname(__FILE__) .  "/dados-publicos"; // Assuming this is the destination folder for extracted files
            $zip->extractTo($destination);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
    
    
}
function download($zip_folder){
    $url = 'http://200.152.38.155/CNPJ/';  
    $zipLinks = array();
    $zipLinks = getZips($url,$zipLinks);
    var_dump($zipLinks);
    
    
    // Download file using file_get_contents() and save it using file_put_contents()
    foreach ($zipLinks as $zipLink) {
        // Download the ZIP file
        echo "Baixando $zipLink\n";
        $zipContent = file_get_contents($zipLink);

    
    #   echo dirname(__FILE__);
    // Save the ZIP file to the source folder
        
        $sourceFolder =  $zip_folder;
        $zipFileName = basename($zipLink);
        $zipFilePath = "$sourceFolder/$zipFileName";
        file_put_contents($zipFilePath, $zipContent);
    
    
    }

}

    function getZips($url,$zipLinks){
        #var_dump($url);
        $html = file_get_contents($url);
        preg_match_all('/href="([a-zA-Z][^"]+)/',$html,$matches);

        #var_dump($matches);

        foreach($matches[1] as $link){
            if(stristr($link,'.zip')){
                echo "$link \n";
                $zipLinks[] = $url . $link;
            
            }elseif(stristr($link,'/')){
                $url .=  $link;
                $zipLinks = getZips($url,$zipLinks);
                $zipLinks[] = $url . $link;
                echo "$link \n";
            }
        }
        return $zipLinks;
    }


/*lista dos arquivos
'''
http://200.152.38.155/CNPJ/Cnaes.zip
http://200.152.38.155/CNPJ/Empresas0.zip
http://200.152.38.155/CNPJ/Empresas1.zip
http://200.152.38.155/CNPJ/Empresas2.zip
http://200.152.38.155/CNPJ/Empresas3.zip
http://200.152.38.155/CNPJ/Empresas4.zip
http://200.152.38.155/CNPJ/Empresas5.zip
http://200.152.38.155/CNPJ/Empresas6.zip
http://200.152.38.155/CNPJ/Empresas7.zip
http://200.152.38.155/CNPJ/Empresas8.zip
http://200.152.38.155/CNPJ/Empresas9.zip
http://200.152.38.155/CNPJ/Estabelecimentos0.zip
http://200.152.38.155/CNPJ/Estabelecimentos1.zip
http://200.152.38.155/CNPJ/Estabelecimentos2.zip
http://200.152.38.155/CNPJ/Estabelecimentos3.zip
http://200.152.38.155/CNPJ/Estabelecimentos4.zip
http://200.152.38.155/CNPJ/Estabelecimentos5.zip
http://200.152.38.155/CNPJ/Estabelecimentos6.zip
http://200.152.38.155/CNPJ/Estabelecimentos7.zip
http://200.152.38.155/CNPJ/Estabelecimentos8.zip
http://200.152.38.155/CNPJ/Estabelecimentos9.zip
http://200.152.38.155/CNPJ/Motivos.zip
http://200.152.38.155/CNPJ/Municipios.zip
http://200.152.38.155/CNPJ/Naturezas.zip
http://200.152.38.155/CNPJ/Paises.zip
http://200.152.38.155/CNPJ/Qualificacoes.zip
http://200.152.38.155/CNPJ/Simples.zip
http://200.152.38.155/CNPJ/Socios0.zip
http://200.152.38.155/CNPJ/Socios1.zip
http://200.152.38.155/CNPJ/Socios2.zip
http://200.152.38.155/CNPJ/Socios3.zip
http://200.152.38.155/CNPJ/Socios4.zip
http://200.152.38.155/CNPJ/Socios5.zip
http://200.152.38.155/CNPJ/Socios6.zip
http://200.152.38.155/CNPJ/Socios7.zip
http://200.152.38.155/CNPJ/Socios8.zip
http://200.152.38.155/CNPJ/Socios9.zip
'''*/
?>
