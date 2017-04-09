<?php
/******** 前端缓存隔离 redis key定义**********/

/**
 * 文章列表 存储有效的文章GUID 有序集合
 * 作用:  存储文章列表，实现缓存分页。
 *
 * KEY = LIST:ARTICLE:INFO:[类型]     类型：1 表示市场咨询，2，表示创业政策。
 * VALUE =  data_article_info  中的 每个文章的GUID，用来查询对应哈希中的数据
 * @author 王通
 */
define('LIST_ARTICLE_INFO_', 'LIST:ARTICLE:INFO:');



/**
 * 文章哈希表   存储未过期的文章详情
 * 作用： 存储具体文章详细信息。实现数据隔离
 *
 * KEY = HASH:ARTICLE:INFO:[GUID]     GUID 为指定文章的唯一标示。
 * VALUE =  data_article_info  表中每个文章的详细信息。
 * @author 王通
 */
define('HASH_ARTICLE_INFO_', 'HASH:ARTICLE:INFO:');



/**
 * 项目融资阶段分类list
 * 作者：张洵之
 * 作用：项目列表信息分类;
 * key = LIST:PROJECT:INFO:[（1--11）];
 * value = data_project_info表中的项目guid;
 *说明：[（1--11）]所填添数字分别对应：1-种子轮 ; 2-天使轮 ; 3-Pre-A轮 ; 4-A轮 ; 5-B轮 ; 6-C轮 ; 7-D轮 ; 8-E轮 ; 9-F轮已上市 ; 10-其他 11-全部在线的项目;
 */
define('LIST_PROJECT_INFO_','LIST:PROJECT:INFO:');



/**
 * 项目详情hash
 * 作者：张洵之
 * 作用：data_project_info表中一条项目记录的Hash缓存
 * key= HASH:PROJECT:INFO:[guid]
 * value = data_project_info表中一条项目记录
 * 说明:filed与data_project_info中一条记录的字段一一对应
 */
define('HASH_PROJECT_INFO_','HASH:PROJECT:INFO:');



/**
 * 评论string
 * 作者：张洵之
 * 作用：存取一个详情页下的所有评论数量;
 * key = STRING:COMMENT:NUM:[内容guid];
 * value = 详情页下的所有评论数量;
 */
define('STRING_COMMENT_NUM_','STRING:COMMENT:NUM:');



/**
 * 评论list
 * 作者：张洵之
 * 作用：用于评论索引;
 * key = LIST:COMMENT:INFO:[内容guid];
 * value = data_comment_info表中的主键id;
 */
define('LIST_COMMENT_INFO_','LIST:COMMENT:INFO:');



/**
 * 评论hash
 * 作者：张洵之
 * 作用：用于存取一条评论的所有信息;
 * key = HASH:COMMENT:INFO:[评论主键id];
 * value = 一条评论的所有信息;
 */
define('HASH_COMMENT_INFO_','HASH:COMMENT:INFO:');



/**
 * 用户信息hash
 * 作者：张洵之
 * 作用：用于存取一条用户信息;
 * key = HASH:USERINFO:INFO:[用户guid];
 * value = data_user_info表中的主键id;
 */
define('HASH_USERINFO_INFO_','HASH:USERINFO:INFO:');



/**
 * 活动信息列表索引
 * 作者：郭庆
 * 作用：用于存储：某一类型的活动，某一状态的活动的所有id
 * KEY = LIST:ACTION:GUID:[活动类型]:[活动状态]
 * VALUE = data_action_info表中满足条件的所有活动id [guid1, guid2, ......]
 * 说明：
 *      LIST:ACTION:GUID:-:[某一个状态]  -> 存储制定状态的所有活动guid
 *      LIST:ACTION:GUID:[活动类型]:[活动状态]  -> 存储指定类型和指定活动状态的所有活动guid
 *      LIST:ACTION:GUID:[活动类型]  -> 存储指定类型的所有活动guid
 */
define('LIST_ACTION_GUID_','LIST:ACTION:GUID:');



/**
 * 活动信息记录
 * 作者：郭庆
 * 作用：用于存储：指定guid的活动所有字段信息
 * KEY = HASH:ACTION:INFO:[活动guid]
 * VALUE = data_action_info表中所有字段（数组类型）['guid' => '....', 'addtime' => '13244545', ......]
 * 注意：
 *      数据库存储的addtime, status, type .....都是int类型，在从redis中取出来使用时要转换为int在进行正常使用
 */
define('HASH_ACTION_INFO_','HASH:ACTION:INFO:');



/**
 * 某一个用户是否报名参加某一个活动
 * 作者：郭庆
 * 作用：用于存储：某一个用户是否报名参加某一个活动
 * KEY = :ACTION:ORDER:[用户id]:[活动id]
 * VALUE = true/false
 */
define('STRING_ACTION_ORDER_','STRING:ACTION:ORDER:');



/**
 * 某一个用户是否报名参加某一个学院活动
 * 作者：郭庆
 * 作用：用于存储：某一个用户是否报名参加某一个学院活动
 * KEY = :ACTION:ORDER:[用户id]:[学院活动id]
 * VALUE = true/false
 */
define('STRING_COLLEGE_ORDER_','STRING:COLLEGE:ORDER:');



/**
 * 学院信息列表索引
 * 作者：郭庆
 * 作用：用于存储：学院某一类型的活动，某一状态的学院活动的所有id
 * KEY = LIST:COLLEGE:[学院活动类型]:[学院活动状态]
 * VALUE = data_college_info表中满足条件的所有学院活动id [guid1, guid2, ......]
 * 说明：
 *      LIST:COLLEGE:-:[某一个状态]  -> 存储制定状态的所有学院活动guid
 *      LIST:COLLEGE:[学院活动类型]:[学院活动状态]  -> 存储指定类型和指定学院活动状态的所有学院活动guid
 *      LIST:COLLEGE:[学院活动类型]  -> 存储指定类型的所有学院活动guid
 */
define('LIST_COLLEGE_','LIST:COLLEGE:');



/**
 * 学院活动信息记录
 * 作者：郭庆
 * 作用：用于存储：指定guid的学院活动所有字段信息
 * KEY = HASH:COLLEGE:INFO:[学院活动guid]
 * VALUE = data_college_info表中所有字段（数组类型）['guid' => '....', 'addtime' => '13244545', ......]
 * 注意：
 *      数据库存储的addtime, status, type .....都是int类型，在从redis中取出来使用时要转换为int在进行正常使用
 */
define('HASH_COLLEGE_INFO_','HASH:COLLEGE:INFO:');



/**
 * 用户账号列表 -- 存储所有用户的账号
 * @author 刘峻廷
 * KEY   = LIST:USER:ACCOUNT:[手机号] or LIST:USER:ACCOUNT:[邮箱] (二期可能加上邮箱登录)
 * VALUE = data_user_login 表中所有用户的手机号（邮箱）
 */
define('LIST_USER_ACCOUNT', 'LIST:USER:ACCOUNT');



/**
 * 用户账号信息表 -- 存储所有用户账号相关信息
 * @author 刘峻廷
 * KEY   = HASH:USER:ACCOUNT:[手机号or邮箱]
 * VALUE = data_user_login 表中用户账户相关所有数据
 */
define('HASH_USER_ACCOUNT_', 'HASH:USER:ACCOUNT:');



/**
 * 网站基本信息列表
 * 作用： 存储网站基本信息的列表。
 *
 * KEY = LIST:WEBADMIN:INFO
 * VALUE = data_web_info 表的ID
 * @author 王通
 */
define('LIST_WEBADMIN_INFO', 'LIST:WEBADMIN:INFO');



/**
 * 网站基本信息内容
 * 作用： 存储网站基本信息的列表。
 *
 * KEY = HASH:WEBADMIN:INFO:[ID]      ID   是信息的索引ID。
 * VALUE = data_web_info 表的未删除信息记录。
 * @author 王通
 */
define('HASH_WEBADMIN_INFO_', 'HASH:WEBADMIN:INFO:');



/**
 * 存储合作，投资机构的索引ID
 * 作用： 存储机构列表的索引。  注意，分类为首页展示时，判断字段值
 *
 * KEY = LIST:PICTURE:INFO
 * VALUE = data_picture_info 表的未删除索引记录。
 * @author 王通
 */
define('LIST_PICTURE_INFO', 'LIST:PICTURE:INFO');



/**
 * 存储合作，投资机构的详细信息
 * 作用： 存储机构列表的索引。
 *
 * KEY = HASH:PICTURE:INFO:[ID]   ID 为机构的索引ID
 * VALUE = data_picture_info 表的未删除记录详情。
 * @author 王通
 */
define('HASH_PICTURE_INFO_', 'HASH:PICTURE:INFO:');



/**
 * 存储轮播图索引ID
 * 作用： 首页轮播图缓存。
 *
 * KEY = LIST:ROLLINGPICTURE:INFO
 * VALUE = data_rollingpicture_info   轮播图的相信信息
 * @author 王通
 */
define('LIST_ROLLINGPICTURE_INFO', 'LIST:ROLLINGPICTURE:INFO');



/**
 * 存储轮播图信息
 * 作用： 首页轮播图缓存，实现数据隔离。
 *
 * KEY = HASH:ROLLINGPICTURE:INFO:[ID]    ID为轮播图的索引ID
 * VALUE = data_rollingpicture_info   轮播图的相信信息
 * @author 王通
 */
define('HASH_ROLLINGPICTURE_INFO_', 'HASH:ROLLINGPICTURE:INFO:');

/**
 * 用户账号缓存
 * String类型
 */
define('String_USER_ACCOUNT_', 'STRING:USER:ACCOUNT:');


/**
 * 用户建议
 * 作用： 存储今天提交过建议的用户IP，防止其二次提交，用的是无序列表
 *
 * KEY = SET:FEEDBACK:IPLIST:[DATE]     意见IP的时间。
 * VALUE =  IP  提意见的用户IP。
 * @author 王通
 */
define('SET_FEEDBACK_IP_', 'SET:FEEDBACK:IPLIST:');
/**
 * 用户建议总数
 * 作用： 存储今天的总用户建议数，如果数量超标，选择性处理
 *
 * KEY = STRING:FEEDBACK:COUNT:[DATE]     每天统计KEY。
 * VALUE =  NUM  标识一个数量数字
 * @author 王通
 */
define('STRING_FEEDBACK_COUNT_', 'STRING:FEEDBACK:COUNT:');
/**
 * 用户建议内容
 * 作用： 存储用户建议的数据
 *
 * KEY = HASH:FEED:BACK:[DATA]     用户的建议时间。
 * VALUE =  每一条建议的内容  标识一个数量数字
 * @author 王通
 */
define('HASH_FEED_BACK_', 'HASH:FEED:BACK:');
/**
 * 用户建议GUID 列表，查询具体数据使用
 * 作用： 存储建议guid列表
 *
 * KEY = LIST:FEED:BACK:INDEX:[DATA]     用户的建议时间。
 * VALUE =  每一条建议的UGID，用来唯一标示这个建议
 * @author 王通
 */
define('LIST_FEED_BACK_INDEX_', 'LIST:FEED:BACK:INDEX:');





