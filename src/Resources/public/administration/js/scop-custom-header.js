(function(){var e={28:function(){},430:function(){},278:function(e,t,n){var a=n(28);a.__esModule&&(a=a.default),"string"==typeof a&&(a=[[e.id,a,""]]),a.locals&&(e.exports=a.locals),n(346).Z("00297c82",a,!0,{})},332:function(e,t,n){var a=n(430);a.__esModule&&(a=a.default),"string"==typeof a&&(a=[[e.id,a,""]]),a.locals&&(e.exports=a.locals),n(346).Z("a8b650c4",a,!0,{})},346:function(e,t,n){"use strict";function a(e,t){for(var n=[],a={},o=0;o<t.length;o++){var l=t[o],s=l[0],i={id:e+":"+o,css:l[1],media:l[2],sourceMap:l[3]};a[s]?a[s].parts.push(i):n.push(a[s]={id:s,parts:[i]})}return n}n.d(t,{Z:function(){return h}});var o="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!o)throw Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var l={},s=o&&(document.head||document.getElementsByTagName("head")[0]),i=null,r=0,d=!1,c=function(){},u=null,m="data-vue-ssr-id",p="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function h(e,t,n,o){d=n,u=o||{};var s=a(e,t);return b(s),function(t){for(var n=[],o=0;o<s.length;o++){var i=l[s[o].id];i.refs--,n.push(i)}t?b(s=a(e,t)):s=[];for(var o=0;o<n.length;o++){var i=n[o];if(0===i.refs){for(var r=0;r<i.parts.length;r++)i.parts[r]();delete l[i.id]}}}}function b(e){for(var t=0;t<e.length;t++){var n=e[t],a=l[n.id];if(a){a.refs++;for(var o=0;o<a.parts.length;o++)a.parts[o](n.parts[o]);for(;o<n.parts.length;o++)a.parts.push(f(n.parts[o]));a.parts.length>n.parts.length&&(a.parts.length=n.parts.length)}else{for(var s=[],o=0;o<n.parts.length;o++)s.push(f(n.parts[o]));l[n.id]={id:n.id,refs:1,parts:s}}}}function g(){var e=document.createElement("style");return e.type="text/css",s.appendChild(e),e}function f(e){var t,n,a=document.querySelector("style["+m+'~="'+e.id+'"]');if(a){if(d)return c;a.parentNode.removeChild(a)}if(p){var o=r++;t=w.bind(null,a=i||(i=g()),o,!1),n=w.bind(null,a,o,!0)}else t=C.bind(null,a=g()),n=function(){a.parentNode.removeChild(a)};return t(e),function(a){a?(a.css!==e.css||a.media!==e.media||a.sourceMap!==e.sourceMap)&&t(e=a):n()}}var v=function(){var e=[];return function(t,n){return e[t]=n,e.filter(Boolean).join("\n")}}();function w(e,t,n,a){var o=n?"":a.css;if(e.styleSheet)e.styleSheet.cssText=v(t,o);else{var l=document.createTextNode(o),s=e.childNodes;s[t]&&e.removeChild(s[t]),s.length?e.insertBefore(l,s[t]):e.appendChild(l)}}function C(e,t){var n=t.css,a=t.media,o=t.sourceMap;if(a&&e.setAttribute("media",a),u.ssrId&&e.setAttribute(m,t.id),o&&(n+="\n/*# sourceURL="+o.sources[0]+" */\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */"),e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}}},t={};function n(a){var o=t[a];if(void 0!==o)return o.exports;var l=t[a]={id:a,exports:{}};return e[a](l,l.exports,n),l.exports}n.d=function(e,t){for(var a in t)n.o(t,a)&&!n.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="bundles/scopcustomheader/",window?.__sw__?.assetPath&&(n.p=window.__sw__.assetPath+"/bundles/scopcustomheader/"),function(){"use strict";let e=Shopware.Data.Criteria,{Component:t,Mixin:a}=Shopware;Shopware.Component.register("scop-custom-header-list",{template:'{% block scop_custom_header_list %}\n    <sw-page class="scop-custom-header-list">\n        <template #smart-bar-actions>\n            {% block scop_custom_header_list_smarbar %}\n                <sw-button variant="primary" :routerLink="{name: \'scop.custom.header.create\'}">\n                    {{ $t(\'scopcustomheader.list.createButton\') }}\n                </sw-button>\n            {% endblock %}\n        </template>\n        <template #content>\n            {% block scop_custom_header_list_content %}\n                <sw-entity-listing\n                        v-if="header"\n                        :items="header"\n                        :repository="repository"\n                        :columns="columns"\n                        detailRoute="scop.custom.header.details"\n                        @update-records="onUpdate"\n                >\n                    <template #column-salesChannel="{ item }">\n                        {{ item.salesChannel ? item.salesChannel.translated.name : $tc(\'scopcustomheader.list.allSalesChannels\') }}\n                    </template>\n                </sw-entity-listing>\n            {% endblock %}\n        </template>\n    </sw-page>\n{% endblock %}\n',inject:["repositoryFactory","syncService","loginService"],mixins:[a.getByName("notification")],data(){return{repository:null,header:null,noHeader:!0,page:1,limit:25}},metaInfo(){return{title:this.$createTitle()}},computed:{columns(){return[{property:"label",dataIndex:"label",label:this.$tc("scopcustomheader.list.label"),routerLink:"scop.custom.header.details",inlineEdit:"string",allowResize:!0,primary:!0},{property:"enabled",dataIndex:"enabled",label:this.$tc("scopcustomheader.list.columnEnabled"),inlineEdit:"boolean"},{property:"salesChannel",dataIndex:"salesChannel",label:this.$tc("scopcustomheader.list.salesChannel"),allowResize:!0}]}},created(){this.repository=this.repositoryFactory.create("scop_custom_header");let t=new e(this.page,this.limit);t.addAssociation("salesChannel"),this.repository.search(t,Shopware.Context.api).then(e=>{this.header=e})},methods:{updateList(){let e=this.header.criteria;this.repository.search(e,Shopware.Context.api).then(e=>{this.header=e})},onUpdate(e){this.noHeader=0===e.length}}});let{Component:o,Mixin:l,State:s}=Shopware,{Criteria:i}=Shopware.Data;o.register("scop-custom-header-details",{template:'{% block scop_custom_header_details %}\n    <sw-page class="scop-custom-header-details">\n\n        {% block sw_product_detail_header %}\n            <template #smart-bar-header>\n                <h2>\n                    {{ placeholder(header, \'label\', $tc(\'scopcustomheader.detail.newHeader\')) }}\n                </h2>\n            </template>\n        {% endblock %}\n        <template #language-switch>\n            <sw-language-switch\n                    :save-changes-function="saveOnLanguageChange"\n                    :abort-change-function="abortOnLanguageChange"\n                    :disabled="!headerId"\n                    @on-change="onChangeLanguage"/>\n        </template>\n        <template #smart-bar-actions>\n            <sw-button :routerLink="{name: \'scop.custom.header.list\'}">\n                {{ $t(\'scopcustomheader.detail.cancelButton\') }}</sw-button>\n            <sw-button-process :isLoading="isLoading"\n                               :processSuccess="processSuccess" variant="primary"\n                               @update:processSuccess="saveFinish" @click="onClickSave">\n                {{ $t(\'scopcustomheader.detail.saveButton\') }}</sw-button-process>\n        </template>\n        <template #content>\n            <sw-card-view>\n                <sw-language-info\n                        :entity-description="placeholder(header, \'label\', $tc(\'scopcustomheader.detail.newHeader\'))"\n                        :is-new-entity="!headerId"\n                />\n                <sw-tabs\n                        v-if="!isCreateMode"\n                        position-identifier="scop-custom-header-details"\n                >\n                    <sw-tabs-item\n                            :route="{ name: \'scop.custom.header.details.base\', params: { id: $route.params.id } }"\n                            :title="$tc(\'scopcustomheader.detail.tabs.tabGeneral\')"\n                    >\n                        {{ $tc(\'scopcustomheader.detail.tabs.tabGeneral\') }}\n                    </sw-tabs-item>\n\n                    <sw-tabs-item\n                            :route="{ name: \'scop.custom.header.details.columns\', params: { id: $route.params.id } }"\n                            :title="$tc(\'scopcustomheader.detail.tabs.tabColumns\')"\n                            :hasError="highlightInvalidColumns"\n                    >\n                        {{ $tc(\'scopcustomheader.detail.tabs.tabColumns\') }}\n                    </sw-tabs-item>\n\n                </sw-tabs>\n\n                <div\n                        v-if="isLoading"\n                >\n                    <sw-skeleton/>\n                    <sw-skeleton/>\n                    <sw-skeleton/>\n                </div>\n\n                <template v-else>\n                    <router-view v-slot="{ Component }">\n                        <component\n                                :is="Component"\n                                :header="header"\n                                :is-create-mode="isCreateMode"\n                        ></component>\n                    </router-view>\n                </template>\n            </sw-card-view>\n        </template>\n    </sw-page>\n{% endblock %}\n',inject:["repositoryFactory","entityValidationService"],mixins:[l.getByName("notification"),l.getByName("placeholder")],props:{headerId:{type:String,required:!1,default(){return null}}},metaInfo(){return{title:this.$createTitle()}},data(){return{header:null,isLoading:!1,processSuccess:!1}},watch:{headerId(){this.getHeader()}},created(){this.isCreateMode&&!s.getters["context/isSystemDefaultLanguage"]&&s.commit("context/resetLanguageToDefault"),this.getHeader()},computed:{isCreateMode(){return"scop.custom.header.create.base"===this.$route.name},headerRepository(){return this.repositoryFactory.create("scop_custom_header")},highlightInvalidColumns:{get(){return s.get("scopHeaderDetail").highlightInvalidColumns},set(e){s.commit("scopHeaderDetail/setHighlightInvalidColumns",e)}}},methods:{getHeader(){if(this.isLoading=!0,!this.headerId){this.header=this.headerRepository.create(),this.header.label="",this.header.priority=1,this.header.height=10,this.header.background="#ffffff",this.header.textFontSize=10,this.header.textColor="#000000",this.header.hover="#14b79f",this.header.paddingTop=10,this.header.paddingBottom=10,this.header.paddingLeft=10,this.header.paddingRight=10,this.header.mobileCarouselSpeed=5,this.isLoading=!1;return}this.loadEntity()},loadEntity(){let e=new i(1,1).addAssociation("columns");if(e.getAssociation("columns").addSorting(i.sort("createdAt","ASC")),this.headerId)return this.headerRepository.get(this.headerId,Shopware.Context.api,e).then(e=>{null!==e&&(this.header=e,this.header&&this.header.columns&&!(this.header.length<1)&&s.commit("scopHeaderDetail/setHeader",this.header))}).finally(()=>{this.isLoading=!1})},onClickSave(){if(!this.headerId){this.createHeader();return}this.saveHeader()},createHeader(){return this.saveHeader().then(()=>{this.processSuccess&&this.$router.push({name:"scop.custom.header.details",params:{id:this.header.id}})})},saveHeader(){if(this.isLoading=!0,!this.entityValidationService.validate(this.header)){let e=this.$tc("global.default.error"),t=this.$tc("global.notification.notificationSaveErrorMessageRequiredFieldsInvalid");return this.createNotificationError({title:e,message:t}),this.isLoading=!1,Promise.resolve()}for(let e of this.header.columns)if((null==e.label||""===e.label)&&null==e.iconId){let e=this.$tc("global.default.error"),t=this.$tc("scopcustomheader.detail.columns.invalidSave");return this.createNotificationError({title:e,message:t}),this.isLoading=!1,this.highlightInvalidColumns=!0,Promise.resolve()}return this.highlightInvalidColumns=!1,this.headerRepository.save(this.header).then(()=>{this.processSuccess=!0,this.loadEntity()}).catch(e=>{this.isLoading=!1,this.createNotificationError({title:this.$tc("scopcustomheader.general.errorTitle"),message:e})})},saveFinish(){this.processSuccess=!1},abortOnLanguageChange(){return this.headerRepository.hasChanges(this.header)},saveOnLanguageChange(){return this.saveHeader()},onChangeLanguage(e){s.commit("context/setApiLanguageId",e),this.getHeader()}}});let{Component:r,Mixin:d}=Shopware,{mapPropertyErrors:c}=Shopware.Component.getComponentHelper();r.register("scop-custom-header-details-base",{template:'<div>\n    <sw-card :title="$tc(\'scopcustomheader.detail.general\')" v-if="header" :is-loading="isLoading">\n        <sw-container columns="3fr 1fr 1fr" gap="16px">\n\n            <sw-text-field :label="$t(\'scopcustomheader.detail.label\')" v-model:value="header.label"\n                           validation="required" required :error="headerLabelError"></sw-text-field>\n\n            <sw-number-field :label="$t(\'scopcustomheader.detail.priority\')" v-model:value="header.priority" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false" required :error="headerPriorityError"></sw-number-field>\n\n            <sw-switch-field :label="$tc(\'scopcustomheader.detail.enabledLabel\')"\n                             v-model:value="header.enabled" validation="required" bordered></sw-switch-field>\n\n        </sw-container>\n        <sw-textarea-field :label="$t(\'scopcustomheader.detail.description\')" v-model:value="header.description"></sw-textarea-field>\n\n{#        <sw-container columns="1fr 1fr" gap="16px">#}\n{#            <sw-datepicker v-model:value="header.validFrom" date-type="datetime" :label="$tc(\'scopcustomheader.detail.validFromLabel\')" :placeholder-text="$tc(\'scopcustomheader.detail.validFromPlaceholder\')"></sw-datepicker>#}\n\n{#            <sw-datepicker v-model:value="header.validUntil" date-type="datetime" :label="$tc(\'scopcustomheader.detail.validUntilLabel\')" :placeholder-text="$tc(\'scopcustomheader.detail.validUntilPlaceholder\')"></sw-datepicker>#}\n{#        </sw-container>#}\n\n        <sw-entity-single-select v-model:value="header.salesChannelId" entity="sales_channel" :resetOption="$t(\'scopcustomheader.detail.salesChannel.all\')" :label="$t(\'scopcustomheader.detail.salesChannel.select\')"></sw-entity-single-select>\n    </sw-card>\n\n    <sw-card :title="$tc(\'scopcustomheader.detail.settingsDesktop\')" v-if="header" :isLoading="isLoading">\n        <sw-number-field :label="$t(\'scopcustomheader.detail.height\')" v-model:value="header.height" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n            <template #suffix>\n                <span>px</span>\n            </template>\n        </sw-number-field>\n\n        <sw-container columns="1fr 1fr 1fr" gap="16px">\n            <sw-colorpicker :label="$t(\'scopcustomheader.detail.backgroundColor\')" v-model:value="header.background" value="#6ed59f" colorOutput="auto" :alpha="true" :disabled="false" :colorLabels="true" zIndex="100"></sw-colorpicker>\n            <sw-colorpicker :label="$t(\'scopcustomheader.detail.hoverColor\')" v-model:value="header.hover" value="#6ed59f" colorOutput="auto" :alpha="true" :disabled="false" :colorLabels="true" zIndex="100"></sw-colorpicker>\n            <sw-colorpicker :label="$t(\'scopcustomheader.detail.textColor\')" v-model:value="header.textColor" value="#6ed59f" colorOutput="auto" :alpha="true" :disabled="false" :colorLabels="true" zIndex="100"></sw-colorpicker>\n        </sw-container>\n\n        <sw-number-field :label="$t(\'scopcustomheader.detail.fontSize\')" v-model:value="header.textFontSize" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n            <template #suffix>\n                <span>px</span>\n            </template>\n        </sw-number-field>\n\n        <sw-container columns="1fr 1fr 1fr 1fr" gap="16px">\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingTop\')" v-model:value="header.paddingTop" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingRight\')" v-model:value="header.paddingRight" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingBottom\')" v-model:value="header.paddingBottom" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingLeft\')" v-model:value="header.paddingLeft" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n        </sw-container>\n\n    </sw-card>\n\n    <sw-card :title="$tc(\'scopcustomheader.detail.settingsMobile\')" v-if="header" :isLoading="isLoading">\n\n        <sw-switch-field :label="$tc(\'scopcustomheader.detail.mobileBreakpointCarouselLabel\')"\n                         v-model:value="header.mobileBreakpointCarousel" validation="required" bordered></sw-switch-field>\n\n        <sw-number-field :label="$t(\'scopcustomheader.detail.mobileCarouselSpeedLabel\')" v-model:value="header.mobileCarouselSpeed" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n            <template #suffix>\n                <span>s</span>\n            </template>\n        </sw-number-field>\n\n        <sw-number-field :label="$t(\'scopcustomheader.detail.height\')" v-model:value="header.heightMobile" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n            <template #suffix>\n                <span>px</span>\n            </template>\n        </sw-number-field>\n\n        <sw-container columns="1fr 1fr 1fr" gap="16px">\n            <sw-colorpicker :label="$t(\'scopcustomheader.detail.backgroundColor\')" v-model:value="header.backgroundColorMobile" value="#6ed59f" colorOutput="auto" :alpha="true" :disabled="false" :colorLabels="true" zIndex="100"></sw-colorpicker>\n            <sw-colorpicker :label="$t(\'scopcustomheader.detail.hoverColor\')" v-model:value="header.hoverColorMobile" value="#6ed59f" colorOutput="auto" :alpha="true" :disabled="false" :colorLabels="true" zIndex="100"></sw-colorpicker>\n            <sw-colorpicker :label="$t(\'scopcustomheader.detail.textColor\')" v-model:value="header.textColorMobile" value="#6ed59f" colorOutput="auto" :alpha="true" :disabled="false" :colorLabels="true" zIndex="100"></sw-colorpicker>\n        </sw-container>\n\n        <sw-number-field :label="$t(\'scopcustomheader.detail.fontSize\')" v-model:value="header.textFontSizeMobile" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n            <template #suffix>\n                <span>px</span>\n            </template>\n        </sw-number-field>\n\n        <sw-container columns="1fr 1fr 1fr 1fr" gap="16px">\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingTop\')" v-model:value="header.paddingTopMobile" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingRight\')" v-model:value="header.paddingRightMobile" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingBottom\')" v-model:value="header.paddingBottomMobile" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n            <sw-number-field :label="$t(\'scopcustomheader.detail.paddingLeft\')" v-model:value="header.paddingLeftMobile" numberType="int" :step="1" :min="0" :value="1" :fillDigits="true" :allowEmpty="false">\n                <template #suffix>\n                    <span>px</span>\n                </template>\n            </sw-number-field>\n        </sw-container>\n    </sw-card>\n</div>',mixins:[d.getByName("placeholder")],props:{header:{type:Object,required:!1,default(){return null}},isLoading:{type:Boolean,required:!1,default:!1},isCreateMode:{type:Boolean,required:!0}},computed:{...c("header",["label","priority"])},data(){return{processSuccess:!1}},watch:{header(){this.createdComponent()}},created(){this.createdComponent()},methods:{createdComponent(){if(!this.header)return}}}),n(332);let{Component:u,Mixin:m,State:p}=Shopware;u.register("scop-custom-header-details-columns",{template:'<div>\n\n    <ul class="scopcustomheader-details-columns__column-list">\n            <scop-custom-header-column-component\n                    v-for="column in sortedColumns"\n                    :key="column.id"\n                    :header="header"\n                    :column="column"\n                    :error="highlightInvalidColumns && hasError(column)"\n                    @column-delete="deleteColumn"\n            >\n            </scop-custom-header-column-component>\n    </ul>\n\n    <div class="scopcustomheader-details-columns__action_add">\n        <sw-button\n                v-tooltip="{\n                        message: $tc(\'scopcustomheader.detail.columns.buttonAddColumnDisabled\'),\n                        disabled: isSystemLanguage,\n                        showOnDisabledElements: true\n                    }"\n                :disabled="!isSystemLanguage"\n                :is-loading="isLoading" variant="ghost" @click="onAddColumn">\n            {{ $tc(\'scopcustomheader.detail.columns.buttonAddColumn\') }}\n        </sw-button>\n    </div>\n\n</div>',inject:["repositoryFactory"],mixins:[m.getByName("placeholder")],data(){},computed:{header(){return p.get("scopHeaderDetail").header},isLoading:{get(){return p.get("scopHeaderDetail").isLoading},set(e){p.commit("scopHeaderDetail/setIsLoading",e)}},highlightInvalidColumns:{get(){return p.get("scopHeaderDetail").highlightInvalidColumns},set(e){p.commit("scopHeaderDetail/setHighlightInvalidColumns",e)}},columns(){return p.get("scopHeaderDetail").header&&p.get("scopHeaderDetail").header.columns},sortedColumns(){return[...this.columns].sort((e,t)=>e.position-t.position)},isSystemLanguage(){return p.get("context").api.systemLanguageId===p.get("context").api.languageId}},methods:{onAddColumn(){let e=this.repositoryFactory.create(this.columns.entity,this.columns.source).create();e.headerId=this.header.id,e.position=this.columns.length+1,e.showDesktop=!0,e.showMobile=!0,this.highlightInvalidColumns=!1,this.columns.push(e)},deleteColumn(e){if(e.isNew()){this.columns.remove(e.id);return}this.isLoading=!0,this.repositoryFactory.create(this.columns.entity,this.columns.source).delete(e.id,this.columns.context).then(()=>{this.columns.remove(e.id),this.isLoading=!1})},sortColumns(){return[...this.columns].sort((e,t)=>e.position-t.position)},hasError(e){return(null==e.label||""===e.label)&&null==e.iconId}}}),n(278),Shopware.Component.register("scop-custom-header-column-component",{template:'<sw-card :title="getTitle" position-identifier="scop-custom-header-column-component" :class="error ? \'scop-has--error\' : \'\'">\n    <sw-context-button class="scop-custom-header-column-component__context-button">\n        <sw-context-menu-item\n                variant="danger"\n                @click="onShowDeleteModal"\n        >\n            {{ $tc(\'scopcustomheader.detail.columns.buttonDeleteColumn\') }}\n        </sw-context-menu-item>\n        <sw-context-menu-item\n                variant="default"\n                v-if="!isFirst(column)"\n                @click="onMoveUp(column)"\n        >\n            {{ $tc(\'scopcustomheader.detail.columns.buttonMoveUp\') }}\n        </sw-context-menu-item>\n        <sw-context-menu-item\n                variant="default"\n                v-if="!isLast(column)"\n                @click="onMoveDown(column)"\n        >\n            {{ $tc(\'scopcustomheader.detail.columns.buttonMoveDown\') }}\n        </sw-context-menu-item>\n    </sw-context-button>\n\n    <sw-container columns="1fr 1fr" gap="16px">\n\n        <sw-text-field :label="$t(\'scopcustomheader.detail.columns.label\')" v-model:value="column.label" :placeholder="column.translated.label"\n                       validation="required"></sw-text-field>\n\n        <sw-text-field :label="$t(\'scopcustomheader.detail.columns.textLink\')" v-model:value="column.textLink" :placeholder="column.translated.textLink"\n                       validation="required"></sw-text-field>\n\n    </sw-container>\n\n    <sw-upload-listener\n            :upload-tag="column.id"\n            auto-upload\n            @media-upload-finish="setMediaItem"\n    ></sw-upload-listener>\n\n    <sw-media-upload-v2\n            :source="column.iconId"\n            :allow-multi-select="false"\n            :upload-tag="column.id"\n            :label="$t(\'scopcustomheader.detail.columns.mediaUpload\')"\n            @sw-media-upload-v2-media-upload-success="setMediaItem"\n            @media-drop="onDropMedia"\n            @media-upload-sidebar-open="onOpenMediaModal"\n            @media-upload-remove-image="onUnlinkIcon"\n    ></sw-media-upload-v2>\n\n    <sw-media-modal-v2\n            v-if="mediaModalIsOpen"\n            variant="full"\n            :allow-multi-select="false"\n            @media-upload-remove-image="onImageRemove"\n            @media-modal-selection-change="onSelectionChanges"\n            @modal-close="onCloseModal"\n    ></sw-media-modal-v2>\n\n    <sw-switch-field :label="$t(\'scopcustomheader.detail.columns.openInNewTab\')"\n                     v-model:value="column.openInNewTab" validation="required"></sw-switch-field>\n\n    <sw-checkbox-field v-model:value="column.showDesktop" :label="$t(\'scopcustomheader.detail.columns.showDesktopLabel\')"></sw-checkbox-field>\n\n    <sw-checkbox-field v-model:value="column.showMobile" :label="$t(\'scopcustomheader.detail.columns.showMobileLabel\')"></sw-checkbox-field>\n\n\n    <sw-modal\n            v-if="showDeleteModal"\n            variant="small"\n            :title="$tc(\'scopcustomheader.detail.columns.delete.confirmTitle\')"\n            @modal-close="onCloseDeleteModal"\n    >\n            <p>\n                {{ $tc(\'scopcustomheader.detail.columns.delete.confirmText\') }}\n            </p>\n\n            <template #modal-footer>\n                    <sw-button\n                            size="small"\n                            @click="onCloseDeleteModal"\n                    >\n                        {{ $tc(\'scopcustomheader.detail.columns.delete.buttonCancel\') }}\n                    </sw-button>\n\n                    <sw-button\n                            size="small"\n                            variant="danger"\n                            @click="onConfirmDelete"\n                    >\n                        {{ $tc(\'scopcustomheader.detail.columns.delete.buttonDelete\') }}\n                    </sw-button>\n            </template>\n    </sw-modal>\n\n\n</sw-card>',inject:["repositoryFactory"],props:{header:{type:Object,required:!0},column:{type:Object,required:!0},error:{type:Boolean,required:!1,default:!1}},data(){return{isLoading:!1,mediaItem:null,mediaModalIsOpen:!1,showDeleteModal:!1}},computed:{getTitle(){return"USP "+this.column.position},sortedColumns(){return this.header.columns.slice().sort((e,t)=>e.position-t.position)}},created(){},methods:{setMediaItem({targetId:e}){this.column.iconId=e},onUnlinkIcon(){this.column.iconId=null},onDropMedia(e){this.setMediaItem({targetId:e.id})},onCloseModal(){this.mediaModalIsOpen=!1},onOpenMediaModal(){this.mediaModalIsOpen=!0},onSelectionChanges(e){let t=e[0];this.setMediaItem({targetId:t.id})},onShowDeleteModal(){this.showDeleteModal=!0},onCloseDeleteModal(){this.showDeleteModal=!1},onConfirmDelete(){this.onCloseDeleteModal(),Shopware.State.commit("scopHeaderDetail/setHighlightInvalidColumns",!1),this.$nextTick(()=>{for(;!this.isLast(this.column);)this.onMoveDown(this.column);this.header.columns.remove(this.column.id)})},isFirst(e){return 1===e.position},isLast(e){return e.position===this.header.columns.length},onMoveUp(e){let t=e.position;this.header.columns.forEach(e=>{e.position===t-1&&e.position++}),e.position--},onMoveDown(e){let t=e.position;this.header.columns.forEach(e=>{e.position===t+1&&e.position--}),e.position++}}});var h=JSON.parse('{"scopcustomheader":{"config":{"information":"Die Konfiguration des Plugins wurde verschoben. Die Konfiguration des Header kann nun in den Einstellungen vorgenommen werden:","link":"Einstellungen -> Shop -> Individueller Header"},"general":{"title":"Individueller Header","errorTitle":"Fehler"},"list":{"createButton":"Header erstellen","label":"Name","columnEnabled":"Aktiv","salesChannel":"Verkaufskanal","allSalesChannels":"Alle"},"detail":{"cancelButton":"Abbrechen","saveButton":"Speichern","label":"Name","description":"Beschreibung","validFrom":"G\xfcltig ab","validFromPlaceholder":"W\xe4hle ein Startdatum","validUntil":"G\xfcltig bis","validUntilPlaceholder":"W\xe4hle ein Enddatum","salesChannel":{"select":"Verkaufskanal ausw\xe4hlen","all":"Alle"},"priority":"Priorit\xe4t","enabledLabel":"Aktiv","general":"Allgemein","settingsDesktop":"Desktop","settingsMobile":"Mobile","height":"H\xf6he der Leiste","backgroundColor":"Hintergrundfarbe","fontSize":"Schriftgr\xf6\xdfe","hoverColor":"Hover Farbe","textColor":"Textfarbe","paddingTop":"Abstand oben","paddingRight":"Abstand rechts","paddingBottom":"Abstand unten","paddingLeft":"Abstand links","tabs":{"tabGeneral":"Allgemein","tabColumns":"Spalten"},"columns":{"buttonAddColumn":"Spalte hinzuf\xfcgen","buttonAddColumnDisabled":"Spalten k\xf6nnen nur in der Standardsprache hinzugef\xfcgt werden","label":"Name","textLink":"Link","openInNewTab":"Link in einem neuen Tab \xf6ffnen","showMobileLabel":"Spalte auf dem Handy anzeigen","showDesktopLabel":"Spalte auf dem Desktop anzeigen","mediaUpload":"Icon","buttonDeleteColumn":"Spalte entfernen","delete":{"confirmTitle":"Spalte entfernen","confirmText":"M\xf6chtest Du diese Spalte wirklich aus dem Header entfernen?","buttonCancel":"Abbrechen","buttonDelete":"Spalte entfernen"},"buttonMoveUp":"Nach oben","buttonMoveDown":"Nach unten","invalidSave":"Jede Spalte muss entweder einen Namen oder ein Icon besitzen!"},"mobileBreakpointCarouselLabel":"In der mobilen Version die Info-Leiste als Karussell darstellen.","mobileCarouselSpeedLabel":"Geschwindigkeit des Karussells","newHeader":"Neuer individueller Header"}}}'),b=JSON.parse('{"scopcustomheader":{"config":{"information":"The Configuration of this plugin was moved. You can now configure you header in the settings:","link":"Settings -> Shop -> Custom Header"},"general":{"title":"Custom Header","errorTitle":"Error"},"list":{"createButton":"Create header","label":"Name","columnEnabled":"Enabled","salesChannel":"Sales channel","allSalesChannels":"All"},"detail":{"cancelButton":"Cancel","saveButton":"Save","label":"Name","description":"Description","validFromLabel":"Valid from","validFromPlaceholder":"Select start date","validUntilLabel":"Valid until","validUntilPlaceholder":"Select end date","salesChannel":{"select":"Select SalesChannel","all":"All"},"priority":"Priority","enabledLabel":"Enabled","general":"General","settingsDesktop":"Desktop","settingsMobile":"Mobile","height":"Header height","backgroundColor":"Background color","fontSize":"Font size","hoverColor":"Hover color","textColor":"Text color","paddingTop":"Padding top","paddingRight":"Padding right","paddingBottom":"Padding bottom","paddingLeft":"Padding left","tabs":{"tabGeneral":"General","tabColumns":"Columns"},"columns":{"buttonAddColumn":"Add column","buttonAddColumnDisabled":"Columns can only be added in the default language","label":"Name","textLink":"Link","openInNewTab":"Open link in new window","showMobileLabel":"Show column on mobile","showDesktopLabel":"Show column on desktop","mediaUpload":"Icon","buttonDeleteColumn":"Delete column","delete":{"confirmTitle":"Delete column","confirmText":"Do you really want to remove this column from the header?","buttonCancel":"Cancel","buttonDelete":"Delete column"},"buttonMoveUp":"Move up","buttonMoveDown":"Move down","invalidSave":"Every column must at least consist of either a name or an icon"},"mobileBreakpointCarouselLabel":"Display the info bar as a carousel in the mobile version.","mobileCarouselSpeedLabel":"Carousel Speed","newHeader":"New Custom Header"}}}');Shopware.State.registerModule("scopHeaderDetail",{namespaced:!0,state(){return{header:null,isLoading:!1,highlightInvalidColumns:!1}},mutations:{setHeader(e,t){e.header=t},setIsLoading(e,t){e.isLoading=t},setHighlightInvalidColumns(e,t){e.highlightInvalidColumns=t}}}),Shopware.Module.register("scop-custom-header",{type:"plugin",name:"scop-custom-header",title:"scopcustomheader.general.title",description:"scopcustomheader.general.title",color:"#019994",icon:"regular-window-terminal",routes:{list:{components:{default:"scop-custom-header-list"},path:"list"},create:{component:"scop-custom-header-details",path:"create",redirect:{name:"scop.custom.header.create.base"},children:{base:{component:"scop-custom-header-details-base",path:"base",meta:{parentPath:"scop.custom.header.list"}}}},details:{component:"scop-custom-header-details",path:"details/:id?",meta:{parentPath:"scop.custom.header.list"},redirect:{name:"scop.custom.header.details.base"},children:{base:{component:"scop-custom-header-details-base",path:"base"},columns:{component:"scop-custom-header-details-columns",path:"columns"}},props:{default:e=>({headerId:e.params.id})}}},settingsItem:[{to:"scop.custom.header.list",group:"shop",icon:"regular-window-terminal"}],snippets:{"de-DE":h,"en-GB":b}}),Shopware.Component.register("scop-customheader-config-information",{template:"<div>\n    <sw-alert variant=\"info\">\n        {{ $t('scopcustomheader.config.information') }}\n        <sw-internal-link\n                :router-link=\"{ name: 'scop.custom.header.list' }\"\n        >\n            {{ $tc('scopcustomheader.config.link') }}\n        </sw-internal-link>\n    </sw-alert>\n</div>\n"})}()})();