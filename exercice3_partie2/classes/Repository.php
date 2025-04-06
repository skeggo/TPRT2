<?php

class Repository
{
    private $pdo;
    private $tableName;
    private $primaryKey;

    /**
     * Constructor
     *
     * @param PDO    
     * @param string 
     * @param string 
     */
    public function __construct(PDO $pdo, string $tableName, string $primaryKey = 'id')
    {
        $this->pdo        = $pdo;
        $this->tableName  = $tableName;
        $this->primaryKey = $primaryKey;
    }

    /**
     * 
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql  = "SELECT * FROM {$this->tableName}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     *
     * @param  mixed 
     * @return array|null
     */
    public function findById($id): ?array
    {
        $sql  = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKey} = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record ?: null;
    }

    /**
     * w
     *    @param array 
     *    @return int 
     */
    public function create(array $data): int
    {
        
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$this->tableName} ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        
        $stmt->execute(array_values($data));

        
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * 
     *
     * @param  mixed $id
     * @return bool  
     */
    public function delete($id): bool
    {
        $sql  = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    
    
}
