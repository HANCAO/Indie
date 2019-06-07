负责数据库相关的处理

1. 数据模型的名字要与数据库表名一致
2. 如果名字不同，需要设置查询的表
    protected $table="users";
3. 如果表名为(users_hero),数据模型名(UsersHero)