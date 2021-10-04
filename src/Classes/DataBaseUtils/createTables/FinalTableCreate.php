<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class FinalTableCreate extends DataBaseControl
{
    protected $bases = ["Category", "City", "Comment", "Evaluations", "Include", "Task", "User"];

    protected $query = "ALTER TABLE `task` ADD FOREIGN KEY (`clientId`) REFERENCES `user` (`id`);

                    ALTER TABLE `evaluations` ADD FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

                    ALTER TABLE `comment` ADD FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

                    ALTER TABLE `comment` ADD FOREIGN KEY (`taskId`) REFERENCES `task` (`id`);

                    ALTER TABLE `include` ADD FOREIGN KEY (`id`) REFERENCES `task` (`id`);

                    ALTER TABLE `task` ADD CONSTRAINT task_FK FOREIGN KEY (`categoryId`) REFERENCES `category`(`id`);

                    ALTER TABLE `userCategory` ADD CONSTRAINT `userCategory_FK` FOREIGN KEY (`categoryId`) REFERENCES `category`(`id`);
                    ALTER TABLE `userCategory` ADD CONSTRAINT `userCategory_FK_1` FOREIGN KEY (`userId`) REFERENCES `user`(`id`);

                    ALTER TABLE `user` ADD CONSTRAINT `user_FK` FOREIGN KEY (`cityId`) REFERENCES `cityTable`(`id`);";
    public function createTables()
    {
        $flag = 0;

        foreach ($this->bases as $base) {

            $baseName = __NAMESPACE__ . '\\' . $base . "Table";
            if (!($this->isTableExist(strtolower($base)))) {
                $execute = new $baseName();
                $execute->createTable();
                $flag = 1;
            }

        }
        if ($flag === 1) {
            $this->createTable();
        }
    }
}
