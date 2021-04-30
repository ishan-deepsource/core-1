import { PaintStyle } from "../styles";
import { Dictionary, TypeDescriptor, PointXY } from '../common';
import { JsPlumbInstance } from "../core";
import { EventGenerator } from "../event-generator";
import { Connection } from "../connector/connection-impl";
import { Endpoint } from "../endpoint/endpoint";
export declare type ComponentParameters = Record<string, any>;
export declare function _removeTypeCssHelper<E>(component: Component, typeIndex: number): void;
export declare function _updateHoverStyle<E>(component: Component): void;
export interface ComponentOptions {
    parameters?: Record<string, any>;
    beforeDetach?: Function;
    beforeDrop?: Function;
    hoverClass?: string;
    events?: Dictionary<(value: any, event: any) => any>;
    scope?: string;
    cssClass?: string;
    data?: any;
}
export declare abstract class Component extends EventGenerator {
    instance: JsPlumbInstance;
    abstract getTypeDescriptor(): string;
    abstract getDefaultOverlayKey(): string;
    abstract getIdPrefix(): string;
    abstract getXY(): PointXY;
    clone: () => Component;
    deleted: boolean;
    segment: number;
    x: number;
    y: number;
    w: number;
    h: number;
    id: string;
    visible: boolean;
    typeId: string;
    params: Dictionary<any>;
    paintStyle: PaintStyle;
    hoverPaintStyle: PaintStyle;
    paintStyleInUse: PaintStyle;
    _hover: boolean;
    lastPaintedAt: string;
    data: any;
    _defaultType: any;
    events: any;
    parameters: ComponentParameters;
    _types: string[];
    _typeCache: {};
    cssClass: string;
    hoverClass: string;
    beforeDetach: Function;
    beforeDrop: Function;
    constructor(instance: JsPlumbInstance, params?: ComponentOptions);
    isDetachAllowed(connection: Connection): boolean;
    isDropAllowed(sourceId: string, targetId: string, scope: string, connection: Connection, dropEndpoint: Endpoint, source?: any, target?: any): any;
    getDefaultType(): TypeDescriptor;
    appendToDefaultType(obj: any): void;
    getId(): string;
    cacheTypeItem(key: string, item: any, typeId: string): void;
    getCachedTypeItem(key: string, typeId: string): any;
    setType(typeId: string, params?: any): void;
    getType(): string[];
    reapplyTypes(params?: any): void;
    hasType(typeId: string): boolean;
    addType(typeId: string, params?: any): void;
    removeType(typeId: string, params?: any): void;
    clearTypes(params?: any, doNotRepaint?: boolean): void;
    toggleType(typeId: string, params?: any): void;
    applyType(t: TypeDescriptor, params?: any): void;
    setPaintStyle(style: PaintStyle): void;
    getPaintStyle(): PaintStyle;
    setHoverPaintStyle(style: PaintStyle): void;
    getHoverPaintStyle(): PaintStyle;
    destroy(force?: boolean): void;
    isHover(): boolean;
    mergeParameters(p: ComponentParameters): void;
    setVisible(v: boolean): void;
    isVisible(): boolean;
    addClass(clazz: string, dontUpdateOverlays?: boolean): void;
    removeClass(clazz: string, dontUpdateOverlays?: boolean): void;
    getClass(): string;
    shouldFireEvent(event: string, value: any, originalEvent?: Event): boolean;
    getData(): any;
    setData(d: any): void;
    mergeData(d: any): void;
}
