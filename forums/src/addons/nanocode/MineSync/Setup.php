<?php

namespace nanocode\MineSync;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    /**
     * Creates the `ncms_group` table
     */
    public function installStep1()
    {
        $this->schemaManager()->createTable("ncms_group", function (Create $table) {
            $table->addColumn("id", "int", 10)->autoIncrement();
            $table->addColumn("name", "varchar", 255);
            $table->addColumn("xf_group_id", "int", 10);
            $table->addColumn("mc_group_id", "varchar", 255);
            $table->addColumn("priority", "int", 10);
            $table->addColumn("css_background_colour", "varchar", 255);
            $table->addColumn("css_font_colour", "varchar", 255);
            $table->addPrimaryKey("id");
        });
    }

    /**
     * Creates the `ncms_key` table
     */
    public function installStep2()
    {
        $this->schemaManager()->createTable("ncms_key", function (Create $table) {
            $table->addColumn("token", "varchar", 36);
            $table->addColumn("uuid", "varchar", 36);
            $table->addColumn("mc_username", "varchar", 16);
            $table->addColumn("valid", "boolean")->setDefault(1);
            $table->addColumn("used", "boolean");
            $table->addColumn("user_id", "int", 10);
            $table->addColumn("create_date", "int", 10);
            $table->addColumn("key_type", "enum", ['LINK', 'REGISTER']);
            $table->addPrimaryKey("token");
        });
    }

    /**
     * Creates the `ncms_playerupdates` table
     */
    public function installStep3()
    {
        $this->schemaManager()->createTable("ncms_playerupdate", function (Create $table) {
            $table->addColumn("id", "int", 10)->autoIncrement();
            $table->addColumn("uuid", "varchar", 36);
            $table->addColumn("mc_username", "varchar", 16);
            $table->addColumn("groups", "varchar", 255);
            $table->addColumn("processed", "boolean");
            $table->addColumn("date", "int");
            $table->addPrimaryKey("id");
        });
    }

    /**
     * Creates the `ncms_newlink` table
     */
    public function installStep4()
    {
        $this->schemaManager()->createTable("ncms_newlink", function (Create $table) {
            $table->addColumn("id", "int", 10)->autoIncrement();
            $table->addColumn("uuid", "varchar", 36);
            $table->addColumn("user_id", "int", 10);
            $table->addColumn("xf_username", "varchar", 50);
            $table->addColumn("link_date", "int", 10);
            $table->addPrimaryKey("id");
        });
    }

    /**
     * Add alters to the `xf_user` table
     */
    public function installStep5()
    {
        $this->schemaManager()->alterTable("xf_user", function (Alter $table) {
            $table->addColumn("ncms_uuid", "varchar", 36)->setDefault("");
            $table->addColumn("ncms_username", "varchar", 16)->setDefault("");
            $table->addColumn("ncms_group", "int", 10)->setDefault(0);
            $table->addColumn("ncms_groups", "varchar", 255)->setDefault("");
            $table->addColumn("ncms_group_change_date", "int", 10)->setDefault(0);
        });
    }

    /**
     * Setup permissions
     */
    public function installStep6()
    {
        $this->applyDefaultPermissions();
    }

    /**
     * Table renames
     */
    public function upgrade3000070Step1()
    {
        $this->schemaManager()->renameTable('apms2_group', 'ncms_group');
        $this->schemaManager()->renameTable('apms2_key', 'ncms_key');
        $this->schemaManager()->renameTable('apms2_newlink', 'ncms_newlink');
        $this->schemaManager()->renameTable('apms2_updateplayercache', 'ncms_playerupdate');
    }

    /**
     * MineSync Table column renames
     */
    public function upgrade3000070Step2()
    {
        $this->schemaManager()->alterTable('ncms_group', function (Alter $table) {
            $table->dropPrimaryKey();
            $table->renameColumn('group_id', 'id');
            $table->renameColumn('group_name', 'name');
            $table->renameColumn('order_priority', 'priority');
            $table->addPrimaryKey('id');
        });

        $this->schemaManager()->alterTable('ncms_key', function (Alter $table) {
            $table->changeColumn('key_type')->resetDefinition()->type("enum", ['LINK', 'REGISTER']);
        });

        $this->schemaManager()->alterTable('ncms_newlink', function (Alter $table) {
            $table->dropPrimaryKey();
            $table->renameColumn('link_id', 'id');
            $table->dropColumns('previously_linked');
            $table->addPrimaryKey('id');
        });

        $this->schemaManager()->alterTable('ncms_playerupdate', function (Alter $table) {
            $table->dropPrimaryKey();
            $table->renameColumn('update_id', 'id');
            $table->addColumn("processed", "boolean");
            $table->addPrimaryKey('id');
        });
    }

    /**
     * XenForo Column renames
     */
    public function upgrade3000070Step3()
    {
        $this->schemaManager()->alterTable('xf_user', function (Alter $alter) {
            $alter->renameColumn('apms2_uuid', 'ncms_uuid');
            $alter->renameColumn('apms2_username', 'ncms_username');
            $alter->renameColumn('apms2_group', 'ncms_group');
            $alter->renameColumn('apms2_groups', 'ncms_groups');
            $alter->renameColumn('apms2_group_change_date', 'ncms_group_change_date');

            $alter->changeColumn("ncms_groups")->resetDefinition()->type("varchar", 255);
        });
    }

    public function upgrade3000470Step1()
    {
        $this->schemaManager()->alterTable('ncms_newlink', function (Alter $alter) {
            $alter->changeColumn('xf_username', 'varchar', 50); // fix bug where length was limited to 16
        });
    }

    public function upgrade3000670Step1()
    {
        // alter xf_user: ncms_groups column definition
        if (strpos($this->schemaManager()->getTableColumnDefinitions("xf_user")['ncms_groups']['Type'], 'varbinary') === 0)
        {
            $this->schemaManager()->alterTable('xf_user', function (Alter $alter) {
                $alter->changeColumn("ncms_groups")->resetDefinition()->type("varchar", 255);
            });
        }

        // set column defaults
        $this->schemaManager()->alterTable('xf_user', function (Alter $alter) {
            $alter->changeColumn("ncms_uuid")->setDefault("");
            $alter->changeColumn("ncms_username")->setDefault("");
            $alter->changeColumn("ncms_group")->setDefault(0);
            $alter->changeColumn("ncms_groups")->setDefault("");
            $alter->changeColumn("ncms_group_change_date")->setDefault(0);
        });
    }

    public function upgrade3000670Step2()
    {
        $this->schemaManager()->alterTable('ncms_playerupdate', function (Alter $alter) {
            $alter->addColumn("date", "int");
        });
    }

    public function postUpgrade($previousVersion, array &$stateChanges)
    {
        if ($this->applyDefaultPermissions())
        {
            $this->app->jobManager()->enqueueUnique(
                'permissionRebuild',
                'XF:PermissionRebuild',
                [],
                false
            );
        }
    }

    /**
     * Remove `ncms_group` table
     */
    public function uninstallStep1()
    {
        $this->schemaManager()->dropTable("ncms_group");
    }

    /**
     * Remove `ncms_key` table
     */
    public function uninstallStep2()
    {
        $this->schemaManager()->dropTable("ncms_key");
    }

    /**
     * Remove `ncms_updateplayercache` table
     */
    public function uninstallStep3()
    {
        $this->schemaManager()->dropTable("ncms_updateplayercache");
    }

    /**
     * Remove `ncms_newlink` table
     */
    public function uninstallStep4()
    {
        $this->schemaManager()->dropTable("ncms_newlink");
    }

    /**
     * Remove alters to `xf_user`
     */
    public function uninstallStep5()
    {
        $this->schemaManager()->alterTable("xf_user", function (Alter $table) {
            $table->dropColumns([
                "ncms_uuid",
                "ncms_username",
                "ncms_group",
                "ncms_groups",
                "ncms_group_change_date"
            ]);
        });
    }

    protected function applyDefaultPermissions($previousVersion = null)
    {
        $applied = false;

        if (!$previousVersion)
        {
            $this->applyGlobalPermission('ncms', 'canLinkAccount', 'general', 'view');
            $this->applyGlobalPermission('ncms', 'canEditDisplayGroup', 'general', 'editProfile');

            $applied = true;
        }

        return $applied;
    }
}