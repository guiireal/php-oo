<?php
require '../../../../usecases/CreateFamousUseCase.php';
require '../../../../usecases/DeleteFamousUseCase.php';
require '../../../../adapters/repositories/FamousPDOPostgreSqlRepository.php';

$famousPDOPostgreSqlRepository = new FamousPDOPostgreSqlRepository();
$listFamousUseCase = new ListFamousUseCase($famousPDOPostgreSqlRepository);
$deleteFamousUseCase = new DeleteFamousUseCase($famousPDOPostgreSqlRepository);

if (!empty($_GET['action']) && $_GET['action'] == 'delete') {
    $id = (int) $_GET['id'];
    $deleteFamousUseCase->handle($id);
}

$famouses = $listFamousUseCase->handle();
$items = '';

if ($famouses) {
    foreach ($famouses as $famous) {
        $item = file_get_contents('../../includes/item.html');
        $item = str_replace('{id}', $famous['id'], $item);
        $item = str_replace('{name}', $famous['name'], $item);
        $items .= $item;
    }
}

$list = file_get_contents('../../templates/index.html');
$list = str_replace('{items}', $items, $list);

print $list;