## 第十九章 组合模式

### 19.2 组合模式

组合模（Composite),将对象组合成树形结构以表示‘部分-整体’的层次结构。组合模式使得用户对单个对象和组合对象的使用具有一致性。[DP]

结构图如下所示

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305161938798.png)

Component组合中的对象声明接口，在适当情况下，实现所有类共有接口的默认行为。声明一个接口用于访问和管理Component的子部件

```php
abstract class Component {
    /**
    * @var string  
    */
    protected  $name;
    
    public __construct(string $name) 
    {
        $this->name = $name;
    }
    
    public abstract Add(Component $c);
    public abstract Remove(Component $c);
    public abstract Display(int $path);
}
```

Leaf在组合中表示叶节点对，叶子点没有子节点。

```php
class Leaf extends Component {
    public function Add(Component $c) {
        echo '不能加入'."</br>";
    }
    
    public function Remove(Component $c) {
        echo '不能删除'."</br>";
    }
    
    public function Display(int $depth) {
        $outputStr = '';
        for($i = 0; $i < $depth; $i++) {
            $outputStr .= '-';
        }
        
        echo $outputStr.$this->name."</br>";
    }
}
```

Composite定义有枝节点行为，用来存储子部件，在Component接口中实现与子部件有关的操作，比如增加Add和删除Remove。

```php
class Composite extends Component {
    /**
    * @var array 
    */
    private $children;

    public function Add(Component $c) {
        $this->children[] = $c;
    }
    
    public function Remove(Component $c) {
        if (!$this->children) {
            return ;
        }
        $index = array_search($c,$this->children);
        unset($c);
    }
    
    public function Display(int $depth) {
        $outputStr = '';
        for($i = 0; $i < $depth; $i++) {
            $outputStr .= '-';
        }
        
        echo $outputStr.$this->name."</br>";
        
        foreach ($this->children as $val) {
            $val->Display($depth+2);
        }
    }
}
```

客户端代码

```php
// 生成树根root，根上在长出两叶LeafA和LeafB
$root = new Composite('root');
$root->Add(new Left("Left A"));
$root->Add(new Left("Left B"));

// 根上长出分枝Composite X,分枝上也有两叶LeafXA和LeafXB
$comp = new Composite('Composite X');
$comp->Add(new Left("Leaf XA"));
$comp->Add(new Left("Leaf XB"));

$root->Add($comp);

// 在Composite X上再长出分枝Composite XY,分枝上也有两叶LeafXYA和LeafXYB
$comp2 = new Composite('Composite XY');
$comp2->Add(new Left("Leaf XYA"));
$comp2->Add(new Left("Leaf XYB"));
$comp->Add($comp2);

//根部又长出两叶Leaf℃和LeafD,可惜LeafD没长牢，被风吹走了
$root->Add (new Leaf ("Leaf C"));
$leaf = new Leaf ("Leaf D");
$root->Add($leaf);
$root->Remove ($leaf);

// 展示大树的样子
$root->display(1);
```

结果类似如下

```shell
-root
---Leaf A
---Leaf B
---Composite X
-----Leaf XA
-----Leaf XB
-----Composite XY
-------Leaf XYA
-------Leaf XYB
---Leaf C
```

### 19.3 透明方式与安全方式

为什么Leaf类当中也有Add和Remove？这种方式叫做透明方式，也就是说在Component中声明所有用来管理子对象的方法，其中包括Add、Remove等。这样实现Component接口的所有子类都具备了Add和Remove。这样做的好处就是叶节点和枝节点对于外界没有区别，它们具备完全一致的行为接口。但问题也很明显，因为Leaf类本身不具备Add()、Remove()方法的功能，所以实现它是没有意义的

Leaf类当中不用Add和Remove方法，可以吗？当然是可以，那么就需要安全方式，也就是在Component接口中不去声明Add和Remove方法，那么子类的Leaf也就不需要去实现它，而是在Composite声明所有用来管理子类对象的方法，这样做就不会出现刚才提到的问题，不过由于不够透明，所以树叶和树枝类将不具有相同的接口，客户端的调用需要做相应的判断，带来了不便。

### 19.4 何时使用组合模式

什么地方用组合模式比较好呢？当你发现需求中是体现部分与整体层次的结构时，以及你希望用户可以忽略组合对象与单个对象的不同，统一地使用组合结构中的所有对象时，就应该考虑用组合模式了

### 19.5 公司管理系统

看目录代码

### 19.6 组合模式的好处

好处：组合对象的类层次结构。基本对象可以被组合成更复杂的组合对象，而这个组合对象又可以被组合，这样不断地递归下去，客户代码中，任何用到基本对象的地方都可以使用组合对象了。用户是不用关心到底是处理一个叶节点还是处理一个组合组件，也就用不着为定义组合而写一些选择判断语句了。组合模式让客户可以一致地使用组合结构和单个对象

## 第二十二章

### 22.2 紧耦合的程序演化

这里去看书理解。

### 22.3 合成/聚合原则

合成/聚合复用原则：尽量使用合成／聚合，尽量不要使用类继承。[J&DP]

合成（Composition，也有翻译成组合）和聚合（Aggregation）都是关联的特殊种类。聚合表示一种弱的‘拥有’关系，体现的是A对象可以包含B对象，但B对象不是A对象的一部分；合成则是一种强的‘拥有’关系，体现了严格的部分和整体的关系，部分和整体的生命周期一样[DPE]。比方说，大雁有两个翅膀，翅膀与大雁是部分和整体的关系，并且它们的生命周期是相同的，于是大雁和翅膀就是合成关系。而大雁是群居动物，所以每只大雁都是属于一个雁群，一个雁群可以有多只大雁，所以大雁和雁群是聚合关系。”

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182002650.png)

合成／聚合复用原则的好处是，优先使用对象的合成/聚合将有助于你保持每个类被封装，并被集中在单个任务上。这样类和类继承层次会保持较小规模，并且不太可能增长为不可控制的庞然大物[DP]。

比如手机品牌和手机软件。手机品牌包含有手机软件，但软件并不是品牌的一部分，所以它们之间是聚合关系

结构图如下：

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182005035.png)

之前的结构图如下

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182006883.png)

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182007128.png)

这两种都会产生很多类图，要注意理解，建议看书

### 22.4 松耦合的程序

手机软件抽象类如下

```php
abstract class HandsetSoft{
    public abstract function Run();
}
```

游戏、通讯录等具体类

```php
//手机游戏
class HandsetGame extends HandsetSoft
{
    public function Run()
    {
        echo "运行手机游戏";
    }
}
 
//手机通讯录
class HandsetAddressList extends HandsetSoft
{
    public function Run()
    {
        echo "运行手机通讯录";
    }
}
```

手机品牌类
```php
abstract class HandsetBrand 
{
    /**
    * @var HandsetSoft
    */
    protected $soft;
    
    // 设置手机软件
    public function SetHandsetSoft(HandsetSoft $soft) 
    {
        // 品牌需要关注软件，所以在机器中安装软件，以备运行
        $this->soft = $soft;
    }
}
```

品牌N品牌M具体类

```php
//手机品牌N
class HandsetBrandN extends HandsetBrand
{
    public function Run()
    {
        $this->soft->Run();
    }
}
 
//手机品牌M
class HandsetBrandM extends HandsetBrand
{
    public function Run()
    {
         $this->soft->Run();
    }
}
```

客户端代码调用

```php
$ab = new HandsetBrandN();
$ab->SetHandsetSoft(new HandsetGame());
$ab->Run();

$ab->SetHandsetSoft(new HandsetAddressList());
$ab->Run();

$ab = new HandsetBrandM();
$ab->SetHandsetSoft(new HandsetGame());
$ab->Run();

$ab->SetHandsetSoft(new HandsetAddressList());
$ab->Run();
```

开放-封闭原则。这样的设计显然不会修改原来的代码，而只是扩展类就行了。合成／聚合复用原则:也就是优先使用对象的合成或聚合，而不是类继承

盲目使用继承当然就会造成麻烦，而其本质原因主要是什么？继承是一种强耦合的结构。父类变，子类就必须要变。用继承时，一定要在是‘is-a’的关系时再考虑使用，而不是任何时候都去使用

### 22.5　桥接模式

桥接模式（Bridge），将抽象部分与它的实现部分分离，使它们都可以独立地变化。

这里需要理解一下，什么叫抽象与它的实现分离，这并不是说，让抽象类与其派生类分离，因为这没有任何意义。实现指的是抽象类和它的派生类用来实现自己的对象[DPE]。就刚才的例子而言，就是让‘手机’既可以按照品牌来分类，也可以按照功能来分类。

将抽象部分与它的实现部分分离？这部分可以大概理解为实现系统可能有多角度分类，每一种分类都有可能变化，那么就把这种多角度分离出来让它们独立变化，减少它们之间的耦合。

按品牌分类实现结构图

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182022448.png)

安软件分类实现结构图

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182022640.png)

由于实现的方式有多种，桥接模式的核心意图就是把这些实现独立出来，让它们各自地变化。这就使得每种实现的变化不会影响其他实现，从而达到应对变化的目的

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305182023366.png)

## 22.6　桥接模式基本代码

代码22.4足够了，需要的自己看书

## 第二十三章 命令模式

烧烤结构图如下：

![](https://cdn.jsdelivr.net/gh/577961141/static@master/202305192005234.png)

抽象命令类

```php
abstract class Command
{
    /**
    * @var Barbecuer
    */
    protected $receiver;
    
    /** 
    * 抽象命令类，只需要确认’烤肉串者‘是谁
    * @param Barbecuer $receiver
    */
    public function __construct(Barbecuer $receiver) {
        $this->receiver = $receiver;
    }
    
    // 执行命令
    public abstract function ExecuteCommand ();
} 
```

具体命令类

```php
// 烤羊肉串命令
class BakeMuttonCommand extends Commond
{
    // 执行命令
    public function ExecuteCommand () 
    {
        $this->receiver->BakeMutton()
    }
} 

// 烤鸡翅命令
class BakeChickenWingCommand extends Commond
{
    // 执行命令
    public function ExecuteCommand () 
    {
        $this->receiver->BakeChickenWing()
    }
} 
```

服务员类

```php
public class Waiter {
    /**
    * @var Command
    */
    private $command;
    
    /**
    * 设置订单 
    * @param Command $command
    * @return void
    */
    public function SetOrder(Command $command) {
        $this->command = $command;
    }
    
    public function Notify() {
        $this->command->ExecuteCommand();
    }
}
```

烤肉串者如下：

```php
//烤肉串者
class Barbecuer
{
    //烤羊肉
    public function BakeMutton()
    {
        echo "烤羊肉串!";
    }
    //烤鸡翅
    public function BakeChickenWing()
    {
        echo "烤鸡翅!";
    }
}
```

客户端代码

```php
// 开店前准备
$boy = new Barbecuer();
$bakeMuttonCommand1 = new BakeMuttonCommand($boy);
$bakeMuttonCommand2 = new BakeMuttonCommand($boy);
$bakeChickenWingCommand1 = new BakeChickenWingCommand($boy);
$girl = new Water();

// 开门营业
$girl->SetOrder($bakeMuttonCommand1);
$girl->Notify();
$girl->SetOrder($bakeMuttonCommand2);
$girl->Notify();
$girl->SetOrder($bakeChickenWingCommand1);
$girl->Notify();
```

这里有几个问题，第一，真实的情况其实并不是用户点一个菜，服务员就通知厨房去做一个，那样不科学，应该是点完烧烤后，服务员一次通知制作；第二，如果此时鸡翅没了，不应该是客户来判断是否还有，客户哪知道有没有呀，应该是服务员或烤肉串者来否决这个请求；第三，客户到底点了哪些烧烤或饮料，这是需要记录日志的，以备收费，也包括后期的统计；第四，客户完全有可能因为点的肉串太多而考虑取消一些还没有制作的肉串。这些问题都需要得到解决

修改如下

服务员类
```php
class Waiter {
    /**
    * @var Comand[] 
    */
    private $orders = [];
    
    //设置订单
    public function SetOrder(Command $command)
    {
        if(!$command) { // 假设没有
            echo "服务员：鸡翅没有了，请点别的烧烤。"；
        } else {
           $this->orders[] =  $command;
           echo '增加订单：'.$command->getname().' 时间：'.date('Y-m-d', time()); // 假装有getName方法记得自己写进去
        }
    }

    //取消订单
    public function CancelOrder(Command $command)
    {
        // 删除$orders里面的数据
        
        echo '取消订单：'.$command->getname().' 时间：'.date('Y-m-d', time()); // 假装有getName方法记得自己写进去
    }

    public function Notify() {
        foreach ($orders as $command){
            $command->ExecuteCommand();
        }
    }
```

客户端代码实现

```php
// 开店前准备
$boy = new Barbecuer();
$bakeMuttonCommand1 = new BakeMuttonCommand($boy);
$bakeMuttonCommand2 = new BakeMuttonCommand($boy);
$bakeChickenWingCommand1 = new BakeChickenWingCommand($boy);
$girl = new Water();

// 开门营业
$girl->SetOrder($bakeMuttonCommand1);
$girl->SetOrder($bakeMuttonCommand2);
$girl->SetOrder($bakeChickenWingCommand1);
$girl->Notify();
```