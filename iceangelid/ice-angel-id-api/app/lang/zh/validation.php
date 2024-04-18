<?php

return array(

  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages here.
  |
  */

  "accepted" => "必须接受:attribute.", 
  "active_url" => ":attribute 不是有效链接", 
  "after" => ":attribute 必须在:date 后.", 
  "alpha" => ":attribute 只能包含英文字母", 
  "alpha_dash" => ":attribute 只能包含英文字母、数字和符号", 
  "alpha_num" => ":attribute 只能包含英文字母和数字", 
  "array" => ":attribute 必须使用一个数组", 
  "before" => ":attribute 必须在 :date 前.", 
  "between" => array(
    "numeric" => ":attribute 必须在:min 和 :max 之间.", 
    "file" => ":attribute 大小必须在:min 和 :max KB 之间", 
    "string" => ":attribute 必须在:min 和 :max 个字符之间.", 
    "array" => ":attribute 数目必须在:min 和 :max 之间", 
  ),
  "confirmed" => "两次输入的:attribute不符合", 
  "date" => ":attribute 不是有效日期", 
  "date_format" => ":attribute 不符合:format 格式.", 
  "different" => ":attribute 与 :other 必须不同", 
  "digits" => ":attribute 必须为:digits 位", 
  "digits_between" => ":attribute 必须在:min 和 :max 位之间", 
  "email" => ":attribute 必须是一个有效的邮箱地址", 
  "exists" => "已选的 :attribute 无效", 
  "image" => ":attribute 必须为图片", 
  "in" => "已选的 :attribute 无效", 
  "integer" => ":attribute 必须为整数", 
  "ip" => ":attribute 必须是有效的IP地址", 
  "max" => array(
    "numeric" => ":attribute 不得大于 :max.", 
    "file" => ":attribute 不得大于 :max KB", 
    "string" => ":attribute 不得少于 :max 项", 
    "array" => ":attribute 不得超过 :max 项", 
  ),
  "mimes" => ":attribute 必须是 :values 格式", 
  "min" => array(
    "numeric" => ":attribute 不得少于 :min", 
    "file" => ":attribute 不得小于 :min KB", 
    "string" => ":attribute 不得少于 :min 字符", 
    "array" => ":attribute 不得超过 :min 项", 
  ),
  "not_in" => "已选的 :attribute 无效", 
  "numeric" => ":attribute 必须是数字", 
  "regex" => ":attribute 格式不可用", 
  "required" => ":attribute 是必填项", 
  "required_if" => "当 :other 为 :value 时， :attribute 为必填项", 
  "required_with" => "当 :value 出现时， :attribute 为必填项", 
  "required_with_all" => "当 :value 出现时， :attribute 为必填项", 
  "required_without" => "当 :value 没有出现时， :attribute 为必填项", 
  "required_without_all" => "当没有任何 :values 值出现时，:attribute 为必填项", 
  "same" => ":attribute 与 :other 必须相匹配", 
  "size" => array(
    "numeric" => ":attribute 必须是 :size.", 
    "file" => ":attribute 必须是 :size KB", 
    "string" => ":attribute 必须是 :size 字符.", 
    "array" => ":attribute 必须包括 :size 项.", 
  ),
  "unique" => ":attribute 已经被使用", 
  "url" => ":attribute格式无效.", 
  "custom" => array(
    "attribute-name" => array(
      "rule-name" => "custom-message", 
    ),
  ),
);
