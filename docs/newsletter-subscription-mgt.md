# 웹진결 뉴스레터 메일링 리스트 구독 관리

## 메뉴 구성

- 1. 메일링 리스트 /admin/structure/mailing-list
- 2. 메일링 리스트 생성 /admin/structure/mailing-list/add
- 3. 메일링 리스트 관리 /admin/structure/mailing-list/1/ |add|import|export|edit|delete
- 4. 메일링 리스트 작업 이력 /admin/reports/audit
- 5. 메일링 리스트 접속기록 보고서 /admin/structure/mailing-list/report

## (api) 뉴스레터 구독 취소 /api/newsletter/unsubscribe/{{ hash }}

- 구독 폼 옆에 취소 버튼 추가
- 뉴스레터 발송 시 구독 취소 링크도 위의 걸로 교체
- 구독 취소 시 list 에서 즉시 삭제 및 로그 추가? vs 이메일 난독화 후 삭제일 기록?

## 2. 구독관리 (이메일주소 목록 화면)

- 테이블명: newsletter_list
- 필드목록: 순번, 이메일주소, 신청일, 취소일, 상태, 재동의, 삭제
- 이메일 검색, 페이징, 신청일 최신순 정렬, 목록 전체 엑셀 다운로드?

- 접근 시 접속이력 기록, 처음 스티비 데이터 이관 후 접속이력 기록 남기기
- 현재 사용자 IP - 접근가능 IP 목록 대조 후 없으면 401

## 3. 작업이력 (작업)

- 테이블명: newsletter_audit_logs
- 필드목록: 번호, 아이디, 이름, IP주소, 작업분류, 구분(추가, 수정, 삭제), 상세내역, 일시
- 접근I관리 (권한, 설명, 등록자)
- 필터: 날짜(시작,종료), 사용자ID, 키워드 검색

스티비는 로그관리, 접근IP관리가 나누어져 있는데 하나로 합치는게 나을 듯..
접근IP 화면은 웬지 처음 로그인하고 작업할 때 사유를 적는 UI가 있는게 아닐지....

## 접속기록점검_기능 관련 메뉴(홈페이지).hwp

- 뉴스레터 관리
- 로그 관리
- 접근IP관리

## 접속기록 점검 보고(양식).hwp

현재 구독자 수

### 1. 접근권한 부여 현황

전체 계정, 관리자 계정, 취급자 계정

### 2. 장기 미사용 계정(ID) 현황

3개월 이상, 6개월 이상

### 3. 인사발령 등 권한 부여, 변경, 회수 내역

대상자 수, 부여/ 변경/ 회수 건수, 특이사항 및 조치내역

### 4. 비정상 행위 발생 현황

1. 접근권한 미부여 계정 등 비인가자에 의한 개인정보 처리 및 접속
2. 인가되지 않은 단말기 · 지역 ( I P )에서 접속
3. 특정 정보주체에 대해 과도하게 조회 또는 다운로드
4. 대량의 개인정보에 대한 조회, 정정, 다운로드, 삭제
5. 짧은 시간에 하나의 계정으로 여러 지역 ( I P)에서 접속

### 5. 필수 접속기록 항목(6가지) 보관 여부

계정, 접속일시, 접속지정보, 정보주체, 수행업무, 다운로드사유

### 6. 개인정보 다운로드 사유 기록 여부

다운로드 기능 제공여부
전체 다운로드 건수
사유 확인 건수
다운로드 사유기록건수
비정상 다운로드 건수

### 7. 접속기록 보존기간 준수 여부

개인정보 보유건수
고유식별 번호보유
민감정보 보유여부
보유기간
보유기간 준수여부

## TODO

- [x] 내역 형식 결정하기
- [x] 구독 신청 시 내역 기록
- [x] 관리자 이메일 CRUD 내역 기록
- [x] 관리자 메일링 리스트 import, export 기록
- [ ] 구독 취소 API 추가
- [ ] 구독 신청 폼 연결

```
mailing_list (mailing_list.admin.inc)
- [x] create:   mailing_list_form_submit
- [-] read:
- [x] update:   mailing_list_form_submit
- [x] delete:   mailing_list_delete_confirm_submit
- [x] import:   mailing_list_import_form_submit
- [x] export:   mailing_list_export

mailing_list_email (mailing_list.module)
- [x] create:       mailing_list_subscription_form_submit
- [-] read:
- [x] update:       mailing_list_subscription_form_submit
- [x] delete:       mailing_list_email_delete_multiple_confirm_form_submit
```
