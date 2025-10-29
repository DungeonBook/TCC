<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<!-- link de CSS da criação de salas -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/sala-cadastro.css">

<div class="container">

    <h3>
        <?php if ($dados['id'] == 0);
        else echo "Editar Sala"; ?>
    </h3>

    <form id="frmSala" method="POST"
        action="<?= BASEURL ?>/controller/SalaController.php?action=save">

        <div class="form-grid">
            <div class="form-group">
                <label for="txtNomeSala">Nome da sala:</label>
                <input type="text" id="txtNomeSala" name="nomeSala" maxlength="100"
                    placeholder="Informe o nome da sua sala"
                    value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getNomeSala() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtQuantMinJogadores">Quantidade mínima de jogadores:</label>
                <input type="number" id="txtQuantMinJogadores" name="quantMinJogadores"
                    placeholder="Informe a quantidade mínima"
                    value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getQuantMinJogadores() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtQuantMaxJogadores">Quantidade máxima de jogadores:</label>
                <input type="number" id="txtQuantMaxJogadores" name="quantMaxJogadores"
                    placeholder="Informe a quantidade máxima"
                    value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getQuantMaxJogadores() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtData">Data da partida:</label>
                <input type="date" id="txtData" name="data"
                    value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getData() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtHoraInicio">Horário de início:</label>
                <input type="time" id="txtHoraInicio" name="horaInicio"
                    value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getHoraInicio() : ''); ?>" />
            </div>

            <div class="form-group">
                <label for="txtHoraFim">Horário de fim:</label>
                <input type="time" id="txtHoraFim" name="horaFim"
                    value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getHoraFim() : ''); ?>" />
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label for="txtLocalizacao">Localização:</label>
                <input type="text" id="txtLocalizacao" name="localizacao" maxlength="50"
                    placeholder="Informe a localização da sala"
                    value="<?php echo (isset($dados['sala']) ? $dados['sala']->getLocalizacao() : ''); ?>" />
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label for="txtDescricao">Descrição:</label>
                <textarea name="descricao" id="txtDescricao" placeholder="Informe a descrição da sala"
                    rows="5"><?php echo (isset($dados['sala']) ? $dados['sala']->getDescricao() : ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="selModalidadeId">Modalidade:</label>
                <select name="modalidadeId" id="selModalidadeId">
                    <option value="">Selecione a modalidade</option>
                    <?php foreach ($dados["modalidades"] as $modalidade): ?>
                        <option value="<?= htmlspecialchars($modalidade->getId()) ?>"
                            <?php if (
                                isset($dados["sala"]) && $dados["sala"]->getModalidade()
                                && $dados["sala"]->getModalidade()->getId() == $modalidade->getId()
                            ) echo "selected"; ?>>
                            <?= htmlspecialchars($modalidade->getDescricao()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />

        <div class="actions">
            <button type="submit">Salvar</button>
            <a class="btn" href="<?= BASEURL ?>/controller/SalaController.php?action=list">Voltar</a>
        </div>
    </form>

    <div style="margin-top:30px;">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>