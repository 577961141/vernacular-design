## 第十一章 迪米特法则

### 11.3 迪米特法则

迪米特法则（LoD）：也叫最少知识原则.如果两个类不必彼此直接通信，那么这两个类就不应该发生直接的相互作用。如果其中一个类需要调用另一个类的某个方法的话，可以通过第三者转发这个调用[J&DP]。

迪米特法则首先强调的前提是在类的结构设计上，每一个类都应当尽量降低成员的访问权限[J&DP]，也就是说，一个类包装好自己的private状态，不需要让别的类知道的字段或行为就不要公开

面向对象的设计原则和面向对象的三大特性本就不是矛盾的。迪米特法则其根本思想，是强调了类之间的松耦合。

类之间的耦合越弱，越有利于复用，一个处在弱耦合的类被修改，不会对有关系的类造成波及。

## 第十二章 外观模式

### 12.4 外观模式

外观模式（Facade）,为子系统中的一组接口提供一个一致的界面，此模式定义了一个高层接口，这个接口使得这一子系统更加容易使用。[DP]

结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/20230514154300.png)

四个子系统的类：

详见DesignPattern/Facade

外观模式完美体现了依赖倒转原则和迪米特法则的思想。

### 12.5 何时使用外观模式

分三个阶段来说
- 首先，在设计初期阶段，应该要有意识的将不同的两个层分离，比如经典的三层架构，就需要考虑在数据访问层和业务逻辑层、业务逻辑层和表示层的层与层之间建立外观Facade，这样可以为复杂的子系统提供一个简单的接口，使得耦合大大降低。
- 其次，在开发阶段，子系统往往因为不断的重构演化而变得越来越复杂，大多数的模式使用时也都会产生很多很小的类，这本是好事，但也给外部调用它们的用户程序带来了使用上的困难，增加外观Facade可以提供一个简单的接口，减少它们之间的依赖。
- 最后，在维护一个遗留的大型系统时，可能这个系统已经非常难以维护和扩展了，但因为它包含非常重要的功能，新的需求开发必须要依赖于它。此时用外观模式Facade也是非常合适的。你可以为新系统开发一个外观Facade类，来提供设计粗糙或高度复杂的遗留代码的比较清晰简单的接口，让新系统与Facade对象交互，Facade与遗留代码交互所有复杂的工作。[R2P]
  ![](https://cdn.jsdelivr.net/gh/577961141/static@master/20230514155631.png)

## 第十三章 建造模式

建造模式结构图

![](https://cdn.jsdelivr.net/gh/577961141/static@master/20230514163112.png)

各部分的作用
- Builder：是为创建一个Product对象的各个部件指定的抽象接口。
- ConcreteBuilder：是具体建造者，实现Builder接口，构造和装配各个部件。
- Product：当然就是那些具体的小人，产品角色
- Director：指挥者，用来根据用户的需求构建小人对象

什么时候用建造这模式？主要用于创建一些复杂的对象，这些对象内部构建间造顺序通常是稳定的，但是对象内部的构建通常面临着复杂的变化。

建造者模式的好处就是使得建造代码与表示代码分离，由于建造者隐藏了该产品是如何组装的，所以若需要改变一个产品的内部表示，只需要再定义一个具体的建造者就可以了。

### 13.6 建造者模式的金额代码

Product类,由多个部件组成

```php
class Product {
    private  $parts = [];
    
    public function add(string $part) 
    {
        $this->parts[] = $part;
    }
    
    public function Show() 
    {
        foreach ($this->parts as $val) {
            echo "输出:".$val.'\n';
        }
    }
}
```

Builder类-抽象建造者类，确定产品由两个部件PartA和PartB组成，并声明一个得到产品建造后结果的方法GetResult。

```php
abstract class Builder {
    public abstract function BuildPartA();
    public abstract function BuildPartB();
    public abstract function GetResult(): Product;
}
```

ConcreteBuilder1类——具体建造者类。

```php
class ConcreteBuilder1 extends  Builder {
    /**
    * @var Product 
    */
    private  $product;
    
    public function __construct() 
    {
        $this->product = new Product()
    }
    
    public  function BuildPartA() 
    {
        $this->product->Add("部件A");
    }
    public  function BuildPartB() 
    {
        $this->product->Add("部件B");
    }
    public  function GetResult(): Product  
    {
        return $this->product;
    }
}
```

ConcreteBuilder2类——具体建造者类。

```php
class ConcreteBuilder2 extends  Builder {
    /**
    * @var Product 
    */
    private  $product;
    
    public function __construct() 
    {
        $this->product = new Product()
    }
    
    public  function BuildPartA() 
    {
        $this->product->Add("部件x");
    }
    public  function BuildPartB() 
    {
        $this->product->Add("部件y");
    }
    public  function GetResult(): Product  
    {
        return $this->product;
    }
}
```

Director类——指挥者类。

```php
class Director{
    public function Construct(Builder $builder) 
    {
        $builder.BuildPartA();
        $builder.BuildPartB();
    }
}
```

客户端代码

```php
$director = new Directory();
$b1 = new ConcreteBuilder1();
$b2 = new ConcreteBuilder2();

$director->Construct($b1);
$p1 = $b1->GetResult();
$p1->show();

$director->Construct($b2);
$p2 = $b2->GetResult();
$p2->show();
```

建造这模式是在当创建复杂对象的算法应该独立于该对象的组成部分以及它们的装配方式时适用的模式。

## 第十四章

### 14.4 解藕实现二

看对应目录test1

### 14.5 观察者模式

观察者模式又叫做发布-订阅模式

观察者模式定义了一种一对多的依赖关系，让多个观察者对象同时监听某个主题对象，这个主题对象在状态发生变化时，会通知所有的观察者，使它们能够自动更新自己

UML如下：
![](https://cdn.jsdelivr.net/gh/577961141/static@master/20230514182422.png)

具体代码看书。

### 14.6 观察者模式的特点

观察者模式的动机：将一个系统分割成一系列相互协作的类有一个很不好的副作用，那就是需要维护相关对象间的一致性。我们不希望为了维持一致性而使各类紧密耦合，这样会给维护、扩展和重用都带来不便[DP]

什么时候使用观察者模式：
- 当一个对象的改变需要同时改变其他对象的时候
- 而且它不知道具体有多少对象有待改变时，应该考虑使用观察者模式
- 抽象模型有两个方面，其中一方面依赖于另一方面，这时用观察者模式可以将这两者封装在独立的对象中使它们各自独立地改变和复用

观察者模式所做的工作其实就是在解除耦合。让耦合的双方都依赖于抽象，而不是依赖于具体。从而使得各自的变化都不会影响另一边的变化。依赖倒转原则的最佳体现。

### 14.7 观察者模式的不足

尽管已经用了依赖倒转原则，但是‘抽象通知者’还是依赖‘抽象观察者’，也就是说，万一没有了抽象观察者这样的接口，我这通知的功能就完不成了。另外就是每个具体观察者，它不一定是‘更新’的方法要调用呀。

比如某通知者没有update()这个方法，有a()这个方法,那就通知不了了。（在后面几节会提出解决方案（使用委托模式））

### 14.8 事件委托的实现

“看股票观察者”类和“看NBA观察者”类，去掉了父类“抽象观察类”，所以补上一些代码，并将“更新”方法名改为各自适合的方法名。（就是上面14.5写的代码）

```php
<?php
// 看股票的同时
class StockObserver
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Subject
     */
    protected $sub;

    public function __construct(string $name, Subject $sub)
    {
        $this->name = $name;
        $this->sub = $sub;
    }
    
    public function CloseStockMarket()
    {
        // TODO: Implement update() method.
        echo $this->sub->getSubjectState().' '.$this->name.'关闭股票行情，继续工作';
    }
}

// 看DBA的同事
class NBAObserver
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Subject
     */
    protected $sub;
    
    public function __construct(string $name, Subject $sub)
    {
        $this->name = $name;
        $this->sub = $sub;
    }

    public function CloseNBADirectSeeding()
    {
        // TODO: Implement update() method.
        echo $this->sub->getSubjectState().' '.$this->name.'关闭DBA直播，继续工作';
    }
}
```

抽象通知者”由于不希望依赖“抽象观察者”，所以“增加”和“减少”的方法也就没有必要了（抽象观察者已经不存在了）

```php
<?php

interface Subject
{
    public function Notify();
    
    public function AttachMethod(object $object, string $methodName);

    public function SetSubjectState(string $action);

    public function getSubjectState() : string;
}
```
下面就是如何处理‘老板’类和‘前台’类的问题，它们当中‘通知’方法有了对‘观察者’遍历，所以不可小视之.这里使用委托模式解决

“老板”类和“前台秘书”类

```php
<?php

class Boss implements Subject
{
    /**
     * @var string
     */
    private $action;

    /**
     * @var array 每个类要更新的方法 
    */
    private $updates;

    public function Notify()
    {
        for ($this->updates as $update) {
            $update['class']->$update['method']();
        }
    }
    
    public function AttachMethod(object $object, string $methodName)
    {
        $this->updates[] = ['class' => $object , 'method' => $methodName];
    }

    public function SetSubjectState(string $action)
    {
        $this->action = $action;
    }

    public function getSubjectState(): string
    {
        return $this->action;
    }
}
```

客户端代码

```php
<?php

// 老板胡汉三
$huhansan = new Boss();

// 看股票的同事
$tongshi1 = new StockObserver("围观查", $huhansan);
// 看dba的同事
$tongshi2 = new NBAObserver("易观查", $huhansan);

$huhansan->AttachMethod($tongshi1, 'CloseStockMarket');
$huhansan->AttachMethod($tongshi2, 'CloseNBADirectSeeding');

// 看dba的同事
$huhansan->SetSubjectState("我胡汉三回来了");

//发出通知
$huhansan->Notify();
```

### 14.9 委托事件说明

委托就是一种引用方法的类型。一旦为委托分配了方法，委托将与该方法具有完全相同的行为。委托方法的使用可以像其他任何方法一样，具有参数和返回值。委托可以看作是对函数的抽象，是函数的‘类’，委托的实例将代表一个具体的函数。

先有观察者模式，再有委托事件技术的，再说，它们各有优缺点，你不妨去看看MSDN，讲得已经很详细了


## 第十六章 状态模式

### 16.5 状态模式

状态模式（State）：当一个对象的内在状态改变时允许改变其行为，这个对象看起来像是改变了其类。[DP]

状态模式主要解决的是当控制一个对象状态转换的条件表达式过于复杂时的情况。把状态的判断逻辑转移到表示不同状态的一系列类当中，可以把复杂的判断逻辑简化。当然，如果这个状态判断很简单，那就没必要用‘状态模式’了

结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/20230514204549.png)

State类，抽象状态类，定义一个接口以封装与Context的一个特定状态相关的行为。

```php
abstract class State {
    public abstract Handle(Context $context);
}
```

ConcreteState类，具体状态，每一个子类实现一个与Context的一个状态相关的行为。

```php
class ConcreteStateA extends State {
    public function handle(Context $context) {
        //  设置下一个状态
        $context->State = new ConcreteStateB();
    }
}

class ConcreteStateB extends State {
    public function handle(Context $context) {
        //  设置下一个状态
        $context->State = new ConcreteStateA();
    }
}
```

Context类，维护一个ConcreteState子类的实例，这个实例定义当前的状态。

```php
class Context {
    /**
    * @var State
    */
    private  $state;
    
    public function __construct(State $state) {
        $this->state = $state;
    }
    
    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }
    
    public function Request() 
    {
        $this->state->handle($this);
    }
}
```

客户端代码

```php
$c = new Context(new ConcreteStateA());

$c->Request();
$c->Request();
$c->Request();
$c->Request();
$c->Request();
```

### 16.6 状态模式的好处和用处

好处：将与特定状态相关的行为局部化，并且将不同状态的行为分割开来[DP]。将特定的状态相关的行为都放入一个对象中，由于所有与状态相关的代码都存在于某个ConcreteState中，所以通过定义新的子类可以很容易地增加新的状态和转换[DP]

状态模式通过把各种状态转移逻辑分布到State的子类之间，来减少相互间的依赖，

什么时候使用状态模式：当一个对象的行为取决于它的状态，并且它必须在运行时刻根据状态改变它的行为时，就可以考虑使用状态模式了。

### 16.7 状态模式-状态模式工作版

UML图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305142054137.png)

抽象状态类，定义一个抽象方法“写程序”

```php
<?php

abstract class State
{
    public abstract function WriteProgram(Work $work);
}
```

上午和中午工作状态类

```php
/**
 * 上午的工作状态
 */
class ForenoonState extends State
{

    public function WriteProgram(Work $work)
    {
        if ($work->getHour() < 12) {
            echo "当前时间：".$work->getHour().'点，上午工作，精神百倍'.'\n';
        } else {
            $work->setState(new NoonState());
            $work->WriteProgram();
        }
    }
}

/**
 * 中午的工作状态
 */
class NoonState extends State
{

    public function WriteProgram(Work $work)
    {
        if ($work->getHour() < 13) {
            echo "当前时间：".$work->getHour().'点，午饭，午休'.'\n';
        } else {
            $work->setState(new AfterNoonState());
            $work->WriteProgram();
        }
    }
}
```

下午和傍晚工作状态类

```php
/**
 * 下午工作状态
 */
class AfterNoonState extends State
{

    public function WriteProgram(Work $work)
    {
        if ($work->getHour() < 17) {
            echo "当前时间：".$work->getHour().'点，下午工作状态还不错，继续努力'.'\n';
        } else {
            $work->setState(new EveningState());
            $work->WriteProgram();
        }
    }
}

/**
 * 傍晚的工作状态
 */
class EveningState extends State
{
    public function WriteProgram(Work $work)
    {
        if ($work->isTaskFinished()) {
            $work->setState(new ResetState());
            $work->WriteProgram();
        } else {
            if ($work->getHour() < 21) {
                echo "当前时间：".$work->getHour().'点，加班哦，疲累至极'.'\n';
            } else {
                $work->setState(new SleepingState());
                $work->WriteProgram();
            }
        }


    }
}
```

睡眠状态和下班休息状态类

```php
/**
 * 睡眠状态
 */
class SleepingState extends State
{

    public function WriteProgram(Work $work)
    {
        echo "当前时间：".$work->getHour().'点，不行了，睡着了'.'\n';
    }
}


/**
 * 下班休息状态状态
 */
class ResetState extends State
{

    public function WriteProgram(Work $work)
    {
        echo "当前时间：".$work->getHour().'点，下班回家了'.'\n';
    }
}
```

工作类，此时没有了过长的分支判断语句。

```php
<?php

class Work
{
    /**
     * @var int
     */
    private $hour;

    /**
     * @var State
     */
    private $state;

    /**
     * @var bool
     */
    private $taskFinished;

    public function __construct()
    {
        $this->state = new ForenoonState();
    }

    /**
     * @return int
     */
    public function getHour(): int
    {
        return $this->hour;
    }

    /**
     * @param int $hour
     */
    public function setHour(int $hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    /**
     * @return bool
     */
    public function isTaskFinished(): bool
    {
        return $this->taskFinished;
    }

    /**
     * @param bool $taskFinished
     */
    public function setTaskFinished(bool $taskFinished): void
    {
        $this->taskFinished = $taskFinished;
    }

    public function WriteProgram()
    {
        $this->state->WriteProgram($this);
    }
}
```

客户端代码

```php
<?php

$emergencyProjects = new Work();
$emergencyProjects->setHour(9);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(10);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(12);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(13);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(14);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(17);

$emergencyProjects->setTaskFinished(false);

$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(19);
$emergencyProjects->WriteProgram();
$emergencyProjects->setHour(22);
```

输出类似如下

```shell
当前时间：9点 上午工作，精神百倍
当前时间：10点 上午工作，精神百倍
当前时间：12点 饿了，午饭；犯困，午休
当前时间：13点 下午状态还不错，继续努力
当前时间：14点 下午状态还不错，继续努力
当前时间：17点 加班哦，疲累之极
当前时间：19点 加班哦，疲累之极
当前时间：22点 不行了，睡着了。
```

## 第十七章 适配器模式

### 17.2 适配器模式

适配器模式（Adapter），将一个类的接口转换成客户希望的另外一个接口。Adapter模式使得原本由于接口不兼容而不能一起工作的那些类可以一起工作。[DP]

适配器模式主要解决什么问题呢？简单地说，就是需要的东西就在面前，但却不能使用，而短时间又无法改造它，于是我们就想办法适配它。有些国家用110 V电压，而我们国家用的是220 V，但我们的电器，比如笔记本电脑是不能什么电压都能用的，但国家不同，电压可能不相同也是事实，于是就用一个电源适配器，只要是电，不管多少伏，都能把电源变成需要的电压，这就是电源适配器的作用。适配器的意思就是使得一个东西适合另一个东西的东西。

什么时候使用?系统的数据和行为都正确，但接口不符时，我们应该考虑用适配器，目的是使控制范围之外的一个原有对象与某个接口匹配。适配器模式主要应用于希望复用一些现存的类，但是接口又与复用环境要求不一致的情况

在GoF的设计模式中，对适配器模式讲了两种类型，类适配器模式和对象适配器模式，由于类适配器模式通过多重继承对一个接口与另一个接口进行匹配，而C#、VB.NET、JAVA等语言都不支持多重继承（C++支持），也就是一个类只有一个父类，所以我们这里主要讲的是对象适配器。

适配器结构图

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305151942375.png)

Target（这是客户所期待的接口。目标可以是具体的或抽象的类，也可以是接口），代码如下

```php
class Target{
    public function Request() {
        echo '普通请求';
    }
}
```

Adaptee（需要适配的类）代码如下：

```php
class Adaptee
{
    public function SpecificRequest() {
        echo "特殊请求";
    }
}
```

Adapter（通过在内部包装一个Adaptee对象，把源接口转换成目标接口）代码如下

```php
class Adapter extends Target {
    private $adaptee;
    
    public function __construct() {
        $this->adaptee = new Adaptee();
    }
    
    public function Request() {
        $this->adaptee->SpecificRequest();
    }
}
```

客户端代码

```php
$target = new Adapter();
$target->Request();
```

### 17.3 何时使用适配器模式

两个类所做的事情相同或相似，但是具有不同的接口时要使用它。客户代码可以统一调用同一接口就行了，这样应该可以更简单、更直接、更紧凑。

好的设计用不上适配器模式的。在双方都不太容易修改的时候再使用适配器模式适配

## 第十八章 备忘录模式

### 18.3 备忘录模式

备忘录（Memento）：在不破坏封装性的前提下，捕获一个对象的内部状态，并在该对象之外保存这个状态。这样以后就可将该对象恢复到原先保存的状态。[DP]

结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305151956721.png)

Originator（发起人）：负责创建一个备忘录Memento，用以记录当前时刻它的内部状态，并可使用备忘录恢复内部状态。Originator可根据需要决定Memento存储Originator的哪些内部状态。

Memento（备忘录）：负责存储Originator对象的内部状态，并可防止Originator以外的其他对象访问备忘录Memento。备忘录有两个接口，Caretaker只能看到备忘录的窄接口，它只能将备忘录传递给其他对象。Originator能够看到一个宽接口，允许它访问返回到先前状态所需的所有数据。

Caretaker（管理者）：负责保存好备忘录Memento，不能对备忘录的内容进行操作或检查。

### 18.4 备忘录模式的基本代码

发起人（Originator）类

```php
class Originator {
    /**
    * @var string 
    */
    private  $state;
    
    public function setState(string $state) 
    {
        $this->state = $state;
    }
    
    public function getState() : string
    {
        return $this->state;
    }
    
    public function CreateMemento() 
    {
        return (new Memento($this->state));
    }
    
    public function SetMemento(Memento $memento) 
    {
        $this->state = $memento->state;
    }
    
    public function Show() {
        echo '当前状态'.$this->state;
    }
}
```

备忘录（Memento）类

```php
class Memento{
    /**
    * @var string  
    */
    private $state; 
    
    public function __construct(string $state) 
    {
        $this->state = $state;
    }
    
    public function getState() : string
    {
        return $this->state;
    }
}
```

管理者（Caretaker）类

```php
class Caretaker{
    /**
    * @var Memento  
    */
    private $memento; 
    
    public function setMemento(Memento $memento) 
    {
        $this->memento = $memento;
    }
    
    public function getMemento() : Memento
    {
        return $this->memento;
    }
}
```

客户端代码

```php
$o = new Originator();
$o->State = "On";

$c = new Caretaker();
$c->setMemento($o->CreateMemento());

$o->State = "Off";
$o->Show(); 

$o->SetMemento($c->getMemento());
$o->Show(); 
```

Memento模式比较适用于功能比较复杂的，但需要维护或记录属性历史的类，或者需要保存的属性只是众多属性中的一小部分时，Originator可以根据保存的Memento信息还原到前一状态

如果在某个系统中使用命令模式时，需要实现命令的撤销功能，那么命令模式可以使用备忘录模式来存储可撤销操作的状态[DP]

### 18.5 练习

看书