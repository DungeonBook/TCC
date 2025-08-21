<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    <?php if ($dados['id'] == 0) echo "Inserir";
    else echo "Alterar"; ?>
</h3>

<div class="container">

    <div class="row" style="margin-top: 10px;">

        <div class="col-6">
            <form id="frmSala" method="POST"
                action="<?= BASEURL ?>/controller/SalaController.php?action=save">

                <div class="mb-3">
                    <label class="form-label" for="txtNomeSala">Nome da sala:</label>

                    <input class="form-control" type="text" id="txtNomeSala" name="nome_sala"
                        maxlength="100" placeholder="Informe o nome da sua sala:"
                        value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getNomeSala() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtQuantMinJogadores">Quantidade miníma de jogadores:</label>
                    <input class="form-control" type="number" id="txtQuantMinJogadores" name="quant_min_jogadores"
                        maxlength="100" placeholder="Informe a quantidade miníma de jogadores:"
                        value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getQuantMinJogadores() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtQuantMaxJogadores">Quantidade máxima de jogadores:</label>
                    <input class="form-control" type="number" id="txtQuantMaxJogadores" name="quant_max_jogadores"
                        maxlength="100" placeholder="Informe a quantidade máxima de jogadores:"
                        value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getQuantMaxJogadores() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtData">Data:</label>
                    <input class="form-control" type="date" id="txtData" name="data"
                        maxlength="50" placeholder="Informe a Data da partida:"
                        value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getData() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtHoraInicio">Horário de início da partida:</label>
                    <input class="form-control" type="time" id="txtHoraInicio" name="hora_inicio"
                        maxlength="50" placeholder="Informe o horário de início da partida"
                        value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getHoraInicio() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtHoraFim">Horário de fim da partida:</label>
                    <input class="form-control" type="time" id="txtHoraFim" name="hora_fim"
                        maxlength="50" placeholder="Informe o horário de fim da partida"
                        value="<?php echo (isset($dados["sala"]) ? $dados["sala"]->getHoraFim() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtLocalizacao">Localização:</label>
                    <input class="form-control" type="text" id="txtLocalizacao" name="localizacao"
                        maxlength="50" placeholder="Informe a localização da sala"
                        value="<?php echo (isset($dados['sala']) ? $dados['sala']->getLocalizacao() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtDescricao">Descrição:</label>
                    <textarea name="descricao" id="txtDescricao" placeholder="Informe a descrição da sala"
                        rows="5" class="form-control"
                    ><?php echo (isset($dados['sala']) ? $dados['sala']->getDescricao() : ''); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="selModalidadeId">Modalidade:</label>
                    <select class="form-select" name="modalidade_id" id="selModalidadeId">
                        <option value="">Selecione a modalidade</option>

                        <?php foreach ($dados["modalidades"] as $modalidade): ?>
                            <option value="<?= htmlspecialchars($modalidade->getId()) ?>"
                                <?php
                                if (isset($dados["sala"]) && $dados["sala"]->getModalidade() 
                                        && $dados["sala"]->getModalidade()->getId() == $modalidade->getId())
                                    echo "selected";
                                ?>>
                                <?= htmlspecialchars($modalidade->getDescricao()) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <input type="hidden" id="hddId" name="id"
                    value="<?= $dados['id']; ?>" />

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
            <a class="btn btn-secondary"
                href="<?= BASEURL ?>/controller/SalaController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>