## 第二十六章 享元模式

### 26.2 享元模式

享元模式（Flyweight），运用共享技术有效地支持大量细粒度的对象。[DP]

享元模式结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305201411623.png)

Flyweight类，它是所有具体享元类的超类或接口，通过这个接口，Flyweight可以接受并作用于外部状态。

```php
abstract class Flyweight
{
    public abstract function Operation(int $extrinsicstate);
}
```

ConcreteFlyweight是继承Flyweight超类或实现Flyweight接口，并为内部状态增加存储空间。

```php
class ConcreteFlyweight extends Flyweight
{
    public function Operation(int $extrinsicstate)
    {
        echo "具体Flyweight:".$extrinsicstate."</br>";
    }
}
```

UnsharedConcreteFlyweight是指那些不需要共享的Flyweight子类。因为Flyweight接口共享成为可能，但它并不强制共享。

```php
class UnsharedConcreteFlyweight extends Flyweight
{
    public function Operation(int $extrinsicstate)
    {
       echo "不共享的具体Flyweight:".$extrinsicstate;
    }
}
```

FlyweightFactory，是一个享元工厂，用来创建并管理Flyweight对象。它主要是用来确保合理地共享Flyweight，当用户请求一个Flyweight时，FlyweightFactory对象提供一个已创建的实例或者创建一个（如果不存在的话）。

```php
class FlyweightFactory
{
    /**
    * @var array 
    */
    private $flyweights = [];
    
    public function __construct() 
    {
        // 初始化工厂时，先生成三个实例
        $flyweights['X'] = new ConcreteFlyweight();
        $flyweights['Y'] = new ConcreteFlyweight();  
        $flyweights['Z'] = new ConcreteFlyweight();   
    }
    
    public function GetFlyweight(string $key) :Flyweight
    {
        return $flyweights[$key] ?? null;
    }
}
```

客户端代码

```php
$extrinsicstate = 22;

// 部分代码外部状态
$f = new FlyweightFactory();

$fx = $f->GetFlyweight("X");
$fx->Operation(--$extrinsicstate);

$fy = $f->GetFlyweight("Y");
$fy->Operation(--$extrinsicstate);

$fz = $f->GetFlyweight("Z");
$fz->Operation(--$extrinsicstate);

$uf = new UnsharedConcreteFlyweight();
$uf->Operation(--$extrinsicstate);
```

结果表示

```JS
具体Flyweight:21
具体Flyweight:20
具体Flyweight:19
不共享的具体Flyweight:18
```

FlyweightFactory根据客户需求返回早已生成好的对象，但一定要事先生成对象实例吗?实际上是不一定需要的，完全可以初始化时什么也不做，到需要时，再去判断对象是否为null来决定是否实例化

为什么要有UnsharedConcreteFlyweight的存在呢？这是因为尽管我们大部分时间都需要共享对象来降低内存的损耗，但个别时候也有可能不需要共享的，那么此时的UnsharedConcreteFlyweight子类就有存在的必要了，它可以解决那些不需要共享对象的问题。

### 26.4 内部状态和外部状态

在享元对象内部并且不会随环境改变而改变的共享部分，可以称为是享元对象的内部状态，而随环境改变而改变的、不可以共享的状态就是外部状态了。事实上，享元模式可以避免大量非常相似类的开销。在程序设计中，有时需要生成大量细粒度的类实例来表示数据。如果能发现这些实例除了几个参数外基本上都是相同的，有时就能够受大幅度地减少需要实例化的类的数量。如果能把那些参数移到类实例的外面，在方法调用时将它们传递进来，就可以通过共享大幅度地减少单个实例的数目。也就是说，享元模式Flyweight执行时所需的状态是有内部的也可能有外部的，内部状态存储于ConcreteFlyweight对象之中，而外部对象则应该考虑由客户端对象存储或计算，当调用Flyweight对象的操作时，将该状态传递给它。（不理解请看书）

再举个例子，建立网站的例子。结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305201428172.png)

用户类，用于网站的客户账号，时“网站”类的外部状态

```php
class User 
{
    /**
    * @var string
    */
    private $name;
    
    public function __construct(string $name) 
    {
        $this->name = $name;
    }
    
    public getName() :string
    {
        return $this->name;
    }
}
```

网站抽象类

```php
abstract class WebSite
{
    /**
    * 使用方法需要传递用户对象
    * @param User $user
    * @return mixed
    */
    abstract public function Use(User $user);
}
```

具体网站类

```php
class ConcreteWebSite extends WebSite
{
    /**
    * @var string 
    */
    private $name = "";
    
    public function __construct(string $name) 
    {
        $this->name = $name;
    }
    
    public function Use(User $user) 
    {
        echo "网站分类".$this->name."用户".$user->getName()."</br>";
    }
}
```

网站工厂类

```php
//网站工厂
class WebSiteFactory
{
    /**
    * @var array 
    */
    private $flyweights = [];
 
    //获得网站分类
    public  GetWebSiteCategory(string $key) : WebSite
    {
        if (!isset($this->flyweights[$key])) {
            $this->flyweights[$key] = new ConcreteWebSite($key);
        }
        
        return $this->flyweights[$key];
    }
 
    //获得网站分类总数
    public GetWebSiteCount() :int
    {
        return count($this->flyweights);
    }
}
```

客户端代码

```php
$f = new WebSiteFactory();

$fx = $f->GetWebSiteCategory("产品展示");
$fx->Use(new User("小菜"));

$fy = $f->GetWebSiteCategory("产品展示");
$fy->Use(new User("大鸟"));

$fy = $f->GetWebSiteCategory("产品展示");
$fz->Use(new User("娇娇"));

$fl = $f->GetWebSiteCategory("博客");
$fl->Use(new User("老顽童"));

$fm = $f->GetWebSiteCategory("博客");
$fm->Use(new User("桃谷六仙"));

$fn = $f->GetWebSiteCategory("博客");
$fn->Use(new User("南海鳄神"));

echo "得到网站分类总数为".$f->GetWebSiteCount();
```

结果显示如下
```js
网站分类：产品展示 用户：小菜
网站分类：产品展示 用户：大鸟
网站分类：产品展示 用户：娇娇
网站分类：博客 用户：老顽童
网站分类：博客 用户：桃谷六仙
网站分类：博客 用户：南海鳄神
得到网站分类总数为 2
```

这样就可以协调内部与外部状态了

### 26.5 享元模式应用

在现实中什么时候才应该考虑使用享元模式呢？如果一个应用程序使用了大量的对象，而大量的这些对象造成了很大的存储开销时就应该考虑使用；还有就是对象的大多数状态可以外部状态，如果删除对象的外部状态，那么可以用相对较少的共享对象取代很多组对象，此时可以考虑使用享元模式

在实际使用中，享元模式到底能达到什么效果呢？用了享元模式，所以有了共享对象，实例总数就大大减少了，如果共享的对象越多，存储节约也就越多，节约量随着共享状态的增多而增大。

书上还有例子，自己去看看

## 第二十七章 解释器模式

### 27.2 解释器模式

解释器模式（interpreter），给定一个语言，定义它的文法的一种表示，并定义一个解释器，这个解释器使用该表示来解释语言中的句子。[DP]

解释器模式需要解决的是，如果一种特定类型的问题发生的频率足够高，那么可能就值得将该问题的各个实例表述为一个简单语言中的句子。这样就可以构建一个解释器，该解释器通过解释这些句子来解决该问题[DP]。比方说，我们常常会在字符串中搜索匹配的字符或判断一个字符串是否符合我们规定的格式，此时一般我们会用什么技术？是不是正则表达式

解释器模式结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305201511352.png)

AbstractExpression（抽象表达式），声明一个抽象的解释操作，这个接口为抽象语法树中所有的节点所共享。

```php
abstract class AbstractExpression
{
    public abstract function Interpret(Context $context);
}
```

TerminalExpression（终结符表达式），实现与文法中的终结符相关联的解释操作。实现抽象表达式中所要求的接口，主要是一个interpret()方法。文法中每一个终结符都有一个具体终结表达式与之相对应。

```php
class TerminalExpression extends AbstractExpression
{
    public function Interpret(Context context)
    {
        echo "终端解释器"."</br>";
    }
}
```

NonterminalExpression（非终结符表达式），为文法中的非终结符实现解释操作。对文法中每一条规则R1、R2……Rn都需要一个具体的非终结符表达式类。通过实现抽象表达式的interpret()方法实现解释操作。解释操作以递归方式调用上面所提到的代表R1、R2……Rn中各个符号的实例变量。
```php
class NonterminalExpression extends AbstractExpression
{
    public function Interpret(Context context)
    {
        echo "非终端解释器""</br>";
    }
}
```

Context，包含解释器之外的一些全局信息。
```php
class Context
{
    /**
    * @var string 
    */
    private $input;
    
    public function setInput(string $input) 
    {
        $this->input = $input;
    }
    
    public function getInput() :string
    {
        return $this->input
    }
  
    /**
    * @var string 
    */
    private  $output;
    
    public function setInput(string $output) 
    {
        $this->output = $output;
    }
    
    public function getInput() :string
    {
        return $this->output
    }
}
```

客户端代码，构建表示该文法定义的语言中一个特定的句子的抽象语法树。调用解释操作。

```php
$context = new Context();
$list = [];
$list[] = new TerminalExpression();
$list[] = new NonterminalExpression();
$list[] = new TerminalExpression();
$list[] = new TerminalExpression();

foreach ($list as $exp)
{
    $exp->Interpret($context);
}

```

结果显示

```js
终端解释器
非终端解释器
终端解释器
终端解释器
```

### 27.3　解释器模式好处

场景：当有一个语言需要解释执行，并且你可将该语言中的句子表示为一个抽象语法树时，可使用解释器模式[DP]。

好处：用了解释器模式，就意味着可以很容易地改变和扩展文法，因为该模式使用类来表示文法规则，你可使用继承来改变或扩展该文法。也比较容易实现文法，因为定义抽象语法树中各个节点的类的实现大体类似，这些类都易于直接编写[DP]。像正则表达式、浏览器等应用

## 第二十八章 访问者模式

### 28.4 用了模式实现

男人+女人+状态

结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305201554167.png)

‘状态’的抽象类和‘人’的抽象类

```php
abstract class Action 
{
    // 得到男人的结论或者反应
    public abstract function GetManConclusion(Man $concreteElementA);
    public abstract function GetWomanConclusion(Woman $concreteElementB);
}

abstract class Person
{
    // 接收
    public abstract function Accept(Action $visitor);
}
```

“这里关键就在于人就只分为男人和女人，这个性别的分类是稳定的，所以可以在状态类中，增加‘男人反应’和‘女人反应’两个方法，方法个数是稳定的，不会很容易的发生变化。而‘人’抽象类中有一个抽象方法‘接受’，它是用来获得‘状态’对象的。每一种具体状态都继承‘状态’抽象类，实现两个反应的方法。

具体“状态”类

```php
class Success extends Action 
{
    // 得到男人的结论或者反应
    public abstract function GetManConclusion(Man $concreteElementA) 
    {
        echo get_class($concreteElementA).get_classs($this).'时，背后多半有一个伟大的女人'。
    }
    public abstract function GetWomanConclusion(Woman $concreteElementB) 
    {
         echo get_class($concreteElementB).get_classs($this).'时，背后大多有一个不成功的女人'。
    }
}

// 失败
class Failing extends Action {
    // 与上面的代码类同，省略
}

// 恋爱
class Amativeness extends Action {
    // 与上面的代码类同，省略
}
```

“男人”类和“女人”类

```php
class Man extends Person 
{
    public abstract function Accept(Action $visitor) 
    {
        // 首先在客户程序中将具体状态作为参数传递给“男人”类完成了一次分派，然后“男人”类调用作为参数的“具体状态”中的方法“男人反应”，同时将自己(this)作为参数传递进去。这便完成了第二次分派
        $visitor->GetManConclusion($this);
    }
}

class Woman extends Person 
{
    public abstract function Accept(Action $visitor) 
    {
        $visitor->GetWomanConclusion($this);
    }
}
```

这里需要提一下当中用到一种双分派的技术，首先在客户程序中将具体状态作为参数传递给“男人”类完成了一次分派，然后“男人”类调用作为参数的“具体状态”中的方法“男人反应”，同时将自己（this）作为参数传递进去。这便完成了第二次分派。双分派意味着得到执行的操作决定于请求的种类和两个接收者的类型。‘接受’方法就是一个双分派的操作，它得到执行的操作不仅决定于‘状态’类的具体状态，还决定于它访问的‘人’的类别。

对象结构类　由于总是需要‘男人’与‘女人’在不同状态的对比，所以我们需要一个‘对象结构’类来针对不同的‘状态’遍历‘男人’与‘女人’，得到不同的反应。

```php
class ObjectStructure 
{
    /**
    * @var  Person[]
    */
    private $elements = [];
    
    public function Attach(Person $element) 
    {
        $this->elements[] = $element;
    }
    
    public function Detach(Person $element) 
    {
        $index = array_search($element, $this->elements);
        unset($this->elements[$index])
    }
    
    public function Display(Action $visitor) 
    {
        foreach($this->elements as $element) {
            $element->Accept($visitor);
        }
    }
}
```

客户端代码

```php
$o = new ObjectStructure();
$o->Attach(new Man());
$o->Attach(new Woman());

// 成功时的反应
$v1 = new Success();
$o->Display($v1);

// 失败时的反应
$v2 = new Failing();
$o->Display($v2);

// 恋爱时的反应
$v3 = new Amativeness();
$o->Display($v3);
```

这样做到底有什么好处呢？如果我们现在要增加‘结婚’的状态来考查‘男人’和‘女人’的反应。只需要增加一个‘状态’子类，就可以在客户端调用来查看，不需要改动其他任何类的代码。

完美的体现了开放-封闭原则。

### 28.5 访问者模式

访问者模式（Visitor），表示一个作用于某对象结构中的各元素的操作。它使你可以在不改变各元素的类的前提下定义作用于这些元素的新操作。[DP]

访问者结构图

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305201618370.png)

在这里，Element就是我们的‘人’类，而ConcreteElementA和ConcreteElementB就是‘男人’和‘女人’，Visitor就是我们写的‘状态’类，具体的ConcreteVisitor就是那些‘成功’、‘失败’、‘恋爱’等等状态。至于ObjectStructure就是‘对象结构’类了。

访问者模式可以实施的前提？就像刚才人类性别只有男人和女人，这时候才可以用访问者模式，有多个，或者时变动的，状态就要跟着改变。你想呀，如果人类的性别不止是男和女，而是可有多种性别，那就意味‘状态’类中的抽象方法就不可能稳定了，每加一种类别，就需要在状态类和它的所有下属类中都增加一个方法，这就不符合开放-封闭原则。**也就是说，访问者模式适用于数据结构相对稳定的系统**

访问者模式，把数据结构和作用于结构上的操作之间的耦合解脱开，使得操作集合可以相对自由地演化。

访问者模式的目的是要把处理从数据结构分离出来。很多系统可以按照算法和数据结构分开，如果这样的系统有比较稳定的数据结构，又有易于变化的算法的话，使用访问者模式就是比较合适的，因为访问者模式使得算法操作的增加变得容易。反之，如果这样的系统的数据结构对象易于变化，经常要有新的数据对象增加进来，

其实访问者模式的优点就是增加新的操作很容易，因为增加新的操作就意味着增加一个新的访问者。访问者模式将有关的行为集中到一个访问者对象中。

那访问者的缺点其实也就是使增加新的数据结构变得困难了。

### 28.6 访问者模式的基本代码

看书