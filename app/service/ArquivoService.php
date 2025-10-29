<?php

require_once(__DIR__ . "/../util/config.php");

class ArquivoService
{

    public function salvarArquivo(array $arquivo)
    {
        if ($arquivo['size'] <= 0)
            return null;

        $arquivoNome = explode('.', $arquivo['name']);
        $arquivoExtensao = $arquivoNome[count($arquivoNome) - 1];


        $nomeUnico = uniqid('arquivo_');
        $nomeArquivoSalvar = $nomeUnico . "." . $arquivoExtensao;

        try {
            if (move_uploaded_file(
                $arquivo["tmp_name"],
                PATH_ARQUIVOS . "/" . $nomeArquivoSalvar
            )) {
                return $nomeArquivoSalvar;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return null;
    }

    public function removerArquivo($nomeArquivo)
    {
        $caminhoArquivo = PATH_ARQUIVOS . "/" . $nomeArquivo;

        if (file_exists($caminhoArquivo))
            unlink($caminhoArquivo);
    }
}
