<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MakeSendMessagesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table=$this->table('send_messages');
        $table
            ->addColumn('message_id', 'integer')
            ->addColumn('date_sent','datetime', ['null' => true])
            ->addColumn('confirmation','string', ['limit'=>128])
            ->addColumn('success','tinyinteger')
            ->addColumn('error_message','text', ['null' => true])
            ->addForeignKey('message_id', 'messages', 'id')
            ->addTimestamps()
            ->create();
    }
}
