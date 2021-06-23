create table cat (
                     cat_id integer primary key,
                     name varchar (255),
                     color varchar(255),
                     number_of_lines integer,
                     sex varchar(20)
);
--
-- private $cat_mapper;
--
-- public function __construct(CatDataMapper $_cat_mapper) {
--         $this->cat_mapper = $_cat_mapper;
-- }
--
--     public function save(Cat $cat) : bool
--     {
--         return $this->cat_mapper->save($cat);
-- }
--
--     public function remove(Cat $cat): bool
--     {
--         return  $this->cat_mapper->remove($cat);
-- }
--
--     public function getById($id): Cat
--     {
--         return  $this->cat_mapper->getById($id);
-- }
--
--     public function all(): array
--     {
--         return  $this->cat_mapper->all();
-- }
--
--     public function getByField($field): array
--     {
--         return  $this->cat_mapper->getByField($field);
-- }