<div class="card card-block-margin">
    <div class="card-body">
        <h5 class="card-title">ToDo List</h5>
        <div class="card-text card-block-margin">
            <form class="sort-block" action="/" id="changeSort" method="get">
                <input type="hidden" name="page" value="<?= $data["paginator"]["currentPage"] ?>">
                <select name="sort" id="sort">
                    <option value="" disabled selected>Choose a sort type</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="is_done">Status</option>
                </select>
            </form>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Task</th>
                    <th>Is Done?</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data["tasks"] as $task): ?>
                <tr>
                    <td><?= $task["id"] ?></td>
                    <td><?= $task["name"] ?></td>
                    <td><?= $task["email"] ?></td>
                    <td>
                        <?php if(\Beejee\App\Core\Classes\Auth::check()): ?>
                            <div class="form-group">
                                <textarea class="form-control taskText-<?= $task["id"] ?>" required rows="2"><?= $task["text"] ?></textarea>

                                <button type="button" data-id="<?= $task["id"] ?>" class="btn btn-outline-dark saveTextTask">Save</button>
                            </div>
                        <?php else: ?>
                        <?= $task["text"] ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <input class="form-check-input changeStatusTask" data-id="<?= $task["id"] ?>" type="checkbox" <?= $task["is_done"] ? "checked" : "" ?> <?= !\Beejee\App\Core\Classes\Auth::check() ? "disabled" : "" ?> value="" id="taskIsDone" />
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <ul class="pagination">
                <li class="page-item <?= $data["paginator"]["currentPage"] <= 1 ? "disabled" : "" ?>">
                    <a class="page-link" href="/?page=<?= $data["paginator"]["currentPage"]-1 ?><?= $data["sorting"]["sortUrlParam"]?>">Previous</a>
                </li>
            <?php for ($page = 1; $page <= $data["paginator"]["total"]; $page++): ?>
                <li class="page-item <?= $page === $data["paginator"]["currentPage"] ? "active" : ""?>"><a class="page-link" href="/?page=<?= $page ?><?= $data["sorting"]["sortUrlParam"]?>"><?= $page ?></a></li>
            <?php endfor; ?>
                <li class="page-item <?= $data["paginator"]["currentPage"] >= $data["paginator"]["total"] ? "disabled" : "" ?>">
                    <a class="page-link" href="/?page=<?= $data["paginator"]["currentPage"]+1 ?><?= $data["sorting"]["sortUrlParam"]?>">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Add Task</h5>
        <div class="card-text card-block-margin">
            <form action="/main/store" method="post" id="addTask" class="form-wrapper">
                <div class="form-outline">
                    <input type="text" id="name" name="name" required class="form-control" />
                    <label class="form-label" for="name">Name</label>
                </div>
                <div class="form-outline">
                    <input type="email" id="email" name="email" required class="form-control" />
                    <label class="form-label" for="email">Email</label>
                </div>
                <div class="form-outline">
                    <textarea class="form-control" id="text" name="text" required rows="2"></textarea>
                    <label class="form-label" for="text">Message</label>
                </div>

                <div class="form-outline">
                    <button type="submit" class="btn btn-outline-primary" id="addTaskButton">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
