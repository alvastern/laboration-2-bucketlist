<?php

class Bucketlist
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getAll(): array
    {
        $statement = $this->pdo->query(
            'SELECT id, name, description, priority, created_at
             FROM bucketlist_items
             ORDER BY priority ASC, created_at DESC, id DESC'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}