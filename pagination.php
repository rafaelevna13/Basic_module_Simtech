<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="?list=1">Start</a>
        </li>
        <?php if ($list > 1) : ?>
            <li class="page-item">
                <a class="page-link" href="?list=<?php echo ($list - 1) ?>">   <  </a>
            </li>
        <?php endif; ?>
        <?php if ($list < $total_list) : ?>
            <li class="page-item">
                <a class="page-link" href="?list=<?php echo ($list + 1) ?>"> > </a>
            </li>
        <?php endif; ?>
        <li class="page-item">
            <a class="page-link" href="?list=<?php echo $total_list ?>">End</a>
        </li>
    </ul>
</nav>

