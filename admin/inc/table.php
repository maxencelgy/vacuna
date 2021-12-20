<?php

require '../vendor/autoload.php';

use JasonGrimes\Paginator;

$currentPage = 1;
$offset = 0;
$itemsPerPage = 20;


if (!empty($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
    $offset = ($currentPage - 1) * $itemsPerPage;
}

$items = getArticlesWithLimit($tableName, $itemsPerPage, 'all', $offset);
$totalItems = countTable($tableName);
$urlPattern = '?page=(:num)';

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
$paginator->setMaxPagesToShow(3);

$listName = $table[0];

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $headTitle; ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <?php showColumnSelectedKey($listName, $avoidColumn); ?>
                    <?php foreach ($listFunc as $funcTable) { ?>
                        <th><?= ucfirst($funcTable); ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <?php showColumnSelectedKey($listName, $avoidColumn); ?>
                    <?php foreach ($listFunc as $funcTable) { ?>
                        <th><?= ucfirst($funcTable); ?></th>
                    <?php } ?>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($items as $list) { ?>
                    <tr>
                        <?php foreach ($list as $key => $value) {
                            showColumnSelectedValue($key, $value, $avoidColumn);
                        } ?>
                        <?php foreach ($listFunc as $funcTable) {
                            $funcName = getNameTable($funcTable);
                            $funcIcon = getTableIcons($funcTable);
                            ?>
                            <td class="btn-<?= $funcName; ?>">
                                <div class="my-2"></div>
                                <a href="<?= $funcName; ?>.php?table=<?= urlencode($tableName); ?>&id=<?php echo $list['id']; ?>"
                                   class="btn btn-info" <?php if ($funcName == 'delete') {
                                    echo 'onclick="return confirm(\'Voulez vous vraiment effacer cet article ?\')" ';
                                }; ?>>
                    <span class="icon text-white-50">
                      <i class="<?= $funcIcon; ?>"></i>
                    </span>
                                </a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($add)) { ?>
            <a href="inc/redict.php?table=<?= urlencode($tableName); ?>" class="btn btn-secondary btn-icon-split">
          <span class="icon text-white-50">
           <i class="fas fa-plus"></i>
          </span>
                <span class="text"><?= $add; ?></span>
            </a>
        <?php } ?>
        <div class="me-auto mt-2">
            <ul class="pagination ">
                <?php if ($paginator->getPrevUrl()): ?>
                    <li class="paginate_button page-item previous"><a class="page-link"
                                                                      href="<?php echo $paginator->getPrevUrl(); ?>"><i class="fas fa-arrow-left"></i>
                            <span class="responsive_hide"> Précedant </span></a></li>
                <?php endif; ?>

                <?php foreach ($paginator->getPages() as $page): ?>
                    <?php if ($page['url']): ?>
                        <li class="paginate_button page-item " <?php echo $page['isCurrent'] ? 'class="active"' : ''; ?>>
                            <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
                        </li>
                    <?php else: ?>
                        <li class="disabled"><span><?php echo $page['num']; ?></span></li>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if ($paginator->getNextUrl()): ?>
                    <li class="paginate_button page-item next"><a href="<?php echo $paginator->getNextUrl(); ?>"
                                                                  class="page-link"><span class="responsive_hide"> Suivant </span><i class="fas fa-arrow-right"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>



