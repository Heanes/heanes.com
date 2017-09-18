# use `doctor.heanes.com`;
set foreign_key_checks = 0;

#----------pre_medical_record--------------------------------------------------------
/*
 * @doc 病案纪录表
 * @author Heanes
 * @time 2015-02-09 14:19:41
 */
drop table if exists `pre_medical_record`;
create table `pre_medical_record` (
    `id`                               int unsigned auto_increment comment '自增ID，主键',
    `pay_type`                         tinyint unsigned default 0 comment  '付款方式',
    `patient_id`                       int unsigned default 0 comment '患者ID',
    `contact_user_name`                varchar(255) default '' comment '联系人姓名',
    `contact_relationship`             varchar(31) default '' comment '联系人关系',
    `contact_address`                  varchar(255) default '' comment '联系人地址',
    `contact_phone`                    varchar(31) default '' comment '联系人电话',
    `get_in_hospital_time`             int unsigned default 0 comment '入院时间',
    `get_out_hospital_time`            int unsigned default 0 comment '入院时间',
    `hospital_room`                    varchar(63) default '' comment '病房',
    `real_time_in_hospital`            float unsigned default 0 comment '实际住院天数',
    `clinic diagnosis`                 varchar(255) default '' comment '门诊诊断',
    `kezhuren`                         varchar(63) default '' comment '科主任',
    `zhuren_yishi`                     varchar(63) default '' comment '主任医师',
    `zhuzhi_yishi`                     varchar(63) default '' comment '主治医师',
    `zhuyuan_yishi`                    varchar(63) default '' comment '住院医师',
    `zeren_hushi`                      varchar(63) default '' comment '进修医师',
    `shixi_yishi`                      varchar(63) default '' comment '实习医师',
    `bianmayuan`                       varchar(63) default '' comment '编码员',
    `disease_quantity`                 tinyint unsigned default 0 comment '病案质量,1-甲,2-乙,3-丙',
    `zhikong_yishi`                    varchar(63) default '' comment '质控医师',
    `zhikog_hushi`                     varchar(63) default '' comment '质控护士',
    `zhikong_date`                     varchar(63) default '' comment '质控日期',
    `get_out_hospital_type`            tinyint unsigned default 0 comment '1-医嘱离院,2-医嘱转院,3-医嘱转社区卫生服务机构/乡镇卫生院,4-非医嘱离院,5-死亡,9-其他',
    `admit_hospital_type2`             varchar(255) default '' comment '拟接受医疗机构名称',
    `admit_hospital_type3`             varchar(255) default '' comment '拟接受医疗机构名称',
    `come_again_in_month`              tinyint unsigned default 0 comment '是否有出院31天内再住院计划,1-无,2-有',
    `come_again_purpose`               varchar(255) default '' comment '再住院目的',
    `head_harm_coma_time_before_day`   varchar(31) default '' comment '颅脑损伤患者昏迷入院前时间天数',
    `head_harm_coma_time_before_hours` varchar(31) default '' comment '颅脑损伤患者昏迷入院前时间小时数',
    `head_harm_coma_time_before_min`   varchar(31) default '' comment '颅脑损伤患者昏迷入院前时间分钟数',
    `head_harm_coma_time_after_day`    varchar(31) default '' comment '颅脑损伤患者昏迷入院后时间天数',
    `head_harm_coma_time_after_hours`  varchar(31) default '' comment '颅脑损伤患者昏迷入院后时间小时数',
    `head_harm_coma_time_after_min`    varchar(31) default '' comment '颅脑损伤患者昏迷入院后时间分钟数',
    `case_type`                        tinyint unsigned default 0 comment '病例分型,1-A,2-B,3-C,4-D',
    `has_ICU`                          tinyint unsigned default 0 comment '是否实施重症监护,1-无,2-有',
    `ICU_time_day`                     int unsigned default 0 comment '重症监护天数',
    `ICU_time_hours`                   int unsigned default 0 comment '重症监护小时数',
    `is_single_entity`                 tinyint unsigned default 0 comment '是否单病种管理,1-是,2-否',
    `clinic_manage`                    tinyint unsigned default 0 comment '实施临床路径管理,1-未进入,2-变异推出,3-完成',
    `DRGs_manage`                      tinyint unsigned default 0 comment '实施DGRs管理,1-无,2-按病种,3-按费用,4-两种都有',
    `use_antibiotic`                   tinyint unsigned default 0 comment '使用抗生素,1-使用,2-未使用',
    `bacteria_culture_check`           tinyint unsigned default 0 comment '细菌培养标本送检,1-是,2-否',
    `legal_infectious_diseases`        tinyint unsigned default 0 comment '法定传染病,1-甲类,2-乙类,3-丙类,4-未定',
    `cancer_stage`                     tinyint unsigned default 0 comment '肿瘤分期',
    `baby_apgar_score`                 int unsigned default 0 comment '新生儿Apgar评分',
    primary key (`id`),
    foreign key(patient_id) references `pre_patient`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '病案纪录表';

#----------pre_patient--------------------------------------------------------
/*
 * @doc 患者数据表
 * @author Heanes
 * @time 2015-02-09 14:19:41
 */
drop table if exists `pre_patient`;
create table `pre_patient` (
    `id`                          int unsigned auto_increment comment '自增ID，主键',
    `user_name`                   varchar(255) default '' comment '患者姓名',
    `gender`                      tinyint unsigned default 0 comment '性别',
    `birthday_year`               varchar(4) default '' comment '出生年份',
    `birthday_month`              varchar(2) default '' comment '出生月份',
    `birthday_date`               varchar(2) default '' comment '出生日期',
    `age`                         smallint unsigned default 0 comment '年龄',
    `country`                     varchar(255) default '' comment '国家',
    `baby_age_count_month`        int unsigned default 0 comment '新生儿年龄月数',
    `baby_weight_born`            varchar(6) default '' comment '新生儿出生体重',
    `baby_weight_now`             varchar(6) default '' comment '新生儿入院体重',
    `address_born`                varchar(255) default '' comment '出生地地址',
    `address_now`                 varchar(255) default '' comment '现居住地',
    `address_now_postcode`        char(6) comment '现在所在地邮编',
    `address_registered`          varchar(255) default '' comment '户口地址',
    `address_registered_postcode` char(6) comment '户口所在地邮编',
    `mobile`                      varchar(31) default '' comment '电话',
    `address_job`                 varchar(255) default '' comment '工作单位及地址',
    `job_phone`                   varchar(63) default '' comment '单位电话',
    `job_postcode`                char(6) comment '工作地邮编',
    `native_place`                varchar(255) default '' comment '籍贯 ',
    `nation`                      varchar(63) default '' comment '民族',
    `id_card`                     varchar(31) default '' comment '身份证号',
    `job`                         varchar(63) default '' comment '职业',
    `marriage`                    tinyint unsigned default 0 comment '婚姻情况,0-未婚,1-已婚,2-丧偶,3-离婚,4-其他',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '患者信息表';

#----------pre_patient_disease--------------------------------------------------------
/*
 * @doc 患者诊断疾病表
 * @author Heanes
 * @time
 */
drop table if exists `pre_patient_disease`;
create table `pre_patient_disease` (
    `id`                            int unsigned auto_increment comment '自增ID，主键',
    `case_id`                       int unsigned default 0 comment '病案ID',
    `chuyuan_diagnose`              varchar(63) default '' comment '出院诊断(病名)',
    `is_primary`                    tinyint unsigned default 0 comment '是否是主要诊断,不是则为其他诊断',
    `disease_code`                  varchar(10) default '' comment '疾病编码',
    `ruyuan_disease_type`           tinyint unsigned default 0 comment '入院病情类型,1-有,2-临床未确定,3-情况不明,4-无',
    `harm_poisoning_cause`          varchar(255) default '' comment '损伤,中毒的外部因素',
    `harm_poisoning_cause_dcode`    varchar(10) default '' comment '损伤中毒的外部因素疾病编码',
    `pathology_diagnose`            varchar(255) default '' comment '病理诊断',
    `pathology_diagnose_dcode`      varchar(10) default '' comment '病理诊断疾病编码',
    `pathology_diagnose_slice_code` varchar(10) default '' comment '病理切片号',
    `drug_allergy`                  tinyint unsigned default 0 comment '药物过敏史,0-无,1-有',
    `drug_allergy_medicine`         varchar(255) default '' comment '过敏药物',
    `dead_patient_body_check`       tinyint unsigned default 0 comment '死亡患者尸检,0-否,1-是',
    `blood_type`                    varchar(2) default '' comment '血型,1-A,2-B,3-O,4-AB,5-不详,6-未查',
    `blood_rh`                      tinyint unsigned default 0 comment '血型Rh,1-阴性,2-阳性,3-不详,4-未查',
    primary key (`id`),
    foreign key(`case_id`) references `pre_medical_record`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '患者诊断疾病表';

#----------pre_doctors--------------------------------------------------------
/*
 * @doc 诊断人数据表
 * @author Heanes
 * @time
 */
drop table if exists `pre_doctors`;
create table `pre_doctors` (
    `id`             int unsigned auto_increment comment '自增ID，主键',
    `user_name`      varchar(31) default '' comment '医师姓名',
    `id_card`        varchar(31) default '' comment '身份证号',
    `doc_level`      varchar(32) default '' comment '医师级别ID',
    `doc_gender`     tinyint unsigned default 0 comment '医师性别',
    `doc_work_year`  float comment '从业年龄',
    `mobilie`        varchar(14) default '' comment '联系电话',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '医师信息表';

#----------pre_diagnose_operation--------------------------------------------------------
/*
 * @doc 病案手术信息
 * @author Heanes
 * @time
 */
drop table if exists `pre_diagnose_operation`;
create table `pre_diagnose_operation` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `case_id`           int unsigned default 0 comment '病案ID',
    `op_id`             int unsigned default 0 comment '手术ID',
    `op_level`          smallint unsigned default 0 comment '手术级别',
    `op_uid`            int unsigned default 0 comment '手术操作人',
    `op_helper1`        int unsigned default 0 comment '手术操作I助理',
    `op_helper2`        int unsigned default 0 comment '手术操作II助理',
    `notch_heal_level`  smallint unsigned default 0 comment '伤口愈合等级',
    `anesthesia_type`   tinyint unsigned default 0 comment '麻醉方式,0-全身麻醉,1-局部麻醉',
    `anesthesia_uid`    int unsigned default 0 comment '麻醉医师用户ID',
    `create_time`       int unsigned default 0 comment '手术操作日期',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`),
    foreign key(`case_id`) references `pre_medical_record`(`id`),
    foreign key(`op_id`) references `pre_operation`(`id`),
    foreign key(`op_uid`) references `pre_doctors`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '病案手术信息';

#----------pre_operation--------------------------------------------------------
/*
 * @doc 手术信息库
 * @author Heanes
 * @time
 */
drop table if exists `pre_operation`;
create table `pre_operation` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `code`          varchar(10) default '' comment '手术操作编码',
    `name`          varchar(255) default '' comment '手术及操作名称',
    `category`      int unsigned default 0 comment '手术类别',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '手术信息库';

#----------pre_patient_drugs--------------------------------------------------------
/*
 * @doc 患者用药表
 * @author Heanes
 * @time
 */
drop table if exists `pre_patient_drugs`;
create table `pre_patient_drugs` (
    `id`                int unsigned auto_increment comment '自增ID，主键',
    `patient_id`        int unsigned default 0 comment '患者ID',
    `drug_id`           int unsigned default 0 comment '药品ID',
    `drug_name`         int unsigned default 0 comment '药品名称',
    `unit`              varchar(255) default '' comment '用药单位',
    `quantity`          int unsigned default 0 comment '用药数量',
    `remark`            varchar(255) default '' comment '用药备注',
    `doctor_id`         int unsigned default 0 comment '开药医师',
    `feed_doctor_id`    int unsigned default 0 comment '用药医师',
    `is_enable`         tinyint unsigned default 1 comment '是否启用',
    `is_deleted`        tinyint unsigned default 0 comment '是否删除',
    `create_time`       int(10) unsigned default 0 comment '添加时间',
    `update_time`       int(10) unsigned default 0 comment '更新时间',
    `create_user`       int unsigned default 0 comment '创建人',
    `update_user`       int unsigned default 0 comment '更新人',
    primary key (`id`),
    foreign key(`patient_id`) references `pre_patient`(`id`),
    foreign key(`drug_id`) references `pre_drugs`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '患者用药表';

#----------pre_drugs--------------------------------------------------------
/*
 * @doc 药品库表
 * @author Heanes
 * @time
 */
drop table if exists `pre_drugs`;
create table `pre_drugs` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `category_id`   int unsigned default 0 comment '药品类别',
    `serial_no`     varchar(12) default '' comment '药品序列号',
    `code`          varchar(10) default '' comment '简称代码',
    `name`          varchar(255) default '' comment '名称',
    `unit`          varchar(4) default '' comment '单位',
    `price`         decimal comment '价格',
    `stock`         int unsigned default 0 comment '库存数量',
    `storage`       varchar(255) default '' comment '存储位置',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '药品库表';

#----------pre_drugs--------------------------------------------------------
/*
 * @doc 药品库分类表
 * @author Heanes
 * @time
 */
drop table if exists `pre_drugs`;
create table `pre_drugs` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '名称',
    `parent_id`     int unsigned default 0 comment '父分类ID',
    `order_number`  int unsigned default 0 comment '排序',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '药品库分类表';

#----------pre_hospital_department--------------------------------------------------------
/*
 * @doc 入院科别库
 * @author Heanes
 * @time
 */
drop table if exists `pre_hospital_department`;
create table `pre_hospital_department` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `name`          varchar(255) default '' comment '入院科别名称',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '入院科别库';

#----------pre_sick_room--------------------------------------------------------
/*
 * @doc 医院病房库
 * @author Heanes
 * @time
 */
drop table if exists `pre_sick_room`;
create table `pre_sick_room` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `num`           varchar(255) default '' comment '病房编号',
    `name`          varchar(255) default '' comment '名称',
    `address`       varchar(255) default '' comment '地址',
    `telephone`     varchar(20) default '' comment '电话',
    `description`   text comment '描述',
    `capacity_num`  smallint unsigned default 0 comment '可住病人最大数量',
    `type`          varchar(255) default '' comment '类别',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '医院病房库';

#----------pre_sick_bed--------------------------------------------------------
/*
 * @doc 医院床位资料库
 * @author Heanes
 * @time
 */
drop table if exists `pre_sick_bed`;
create table `pre_sick_bed` (
    `id`            int unsigned auto_increment comment '自增ID，主键',
    `room_id`       int unsigned default 0 comment '病房编号',
    `name`          smallint unsigned default 0 comment '病床名称',
    `descrpiton`    text comment '描述',
    `type`          varchar(255) default '' comment '病床类别',
    `price`         decimal comment '价格',
    `is_enable`     tinyint unsigned default 1 comment '是否启用',
    `is_deleted`    tinyint unsigned default 0 comment '是否删除',
    `create_time`   int(10) unsigned default 0 comment '添加时间',
    `update_time`   int(10) unsigned default 0 comment '更新时间',
    `create_user`   int unsigned default 0 comment '创建人',
    `update_user`   int unsigned default 0 comment '更新人',
    primary key (`id`),
    foreign key(`room_id`) references `pre_sick_room`(`id`)
)
engine = innodb
auto_increment = 1
default charset = `utf8`
comment '医院床位资料库';
